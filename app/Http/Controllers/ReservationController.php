<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Daysoff;
use App\Models\MaxPlace;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Mail\NewReservationMail;
use App\Mail\ConfirmReservationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function save_reservation(Request $request){
              //dd($request->users);
              $validator = Validator::make($request->all(), [
                'users' => 'required|array',
                // 'answers.*.false_answers' => 'required|array|min:1',
                // 'answers.*.true_answers' => 'required|array|min:1',
                'form' => 'required|array',
            ]);
        
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'message' => $validator->errors()
                ];
                return response()->json($response, 200);
            }

            $data = $request->all();
            $users = $data['users'];
            $form = $data['form'];

            // dd($users);

            $reservation = new Reservation();  
            $reservation->user_id = Auth::user()->id;
            $reservation->date = $form['date'];
            $reservation->hours = $form['hours'];
            $reservation->number_of_people = $form['number_of_people'];
            $reservation->save();
        
           
            foreach ($users as $item) {
                $person = new People();
                $person->fullname = $item;
                $person->reservation_id = $reservation->id;
                $person->save();
            }
            
            Mail::to('romuald91303142@gmail.com')->send(new NewReservationMail($reservation->date,$reservation->hours,$reservation->number_of_people,Auth::user()->name,Auth::user()->email,Auth::user()->number));
            Mail::to('contact@pulpo-azul.org')->send(new NewReservationMail($reservation->date,$reservation->hours,$reservation->number_of_people,Auth::user()->name,Auth::user()->email,Auth::user()->number));
            Mail::to(Auth::user()->email)->send(new ConfirmReservationMail($reservation->date,$reservation->hours,$reservation->number_of_people,Auth::user()->name,Auth::user()->email,Auth::user()->number));

            $response = [
                'success' => true,
                'message' => 'succès'
            ];
        
            return response()->json($response, 200);

    }

    public function get_reamining_seats($date,$hours){

        $reservations = Reservation::where('date', $date)
        ->where('hours', $hours)
        ->pluck('number_of_people');

        $sum = $reservations->sum();

        
        $maxplace = MaxPlace::find('1');
        
        $reamining_seats = $maxplace->number - $sum;

        $daysoff = Daysoff::all();

         foreach($daysoff as $item){

            if($item->date == $date && $item->hours == $hours){

                $reamining_seats = 0;
            }

        }

        return  $reamining_seats;

    }

    public function get_reservations(){

        $reservations = Reservation::latest()->with(['people','user'])->get();

        return $reservations;

    }

}


