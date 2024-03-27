<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Reservation;
use Illuminate\Http\Request;
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
            $reservation->email = $form['email'];    
            $reservation->phone = $form['phone'];
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

        $reamining_seats = 7 - $sum;

        return  $reamining_seats;

    }

}


