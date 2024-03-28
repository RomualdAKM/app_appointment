<?php

namespace App\Http\Controllers;

use App\Models\Daysoff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DaysoffController extends Controller
{
   public function save_day_off(Request $request){

    $validator = Validator::make($request->all(), [
        'date' => 'required',
        'hours' => 'required',
    ]);

    if ($validator->fails()) {
        $response = [
            'success' => false,
            'message' => $validator->errors()
        ];
        return response()->json($response, 200);
    }

    $daysoff = new Daysoff();  
    $daysoff->date = $request->date;
    $daysoff->hours = $request->hours;
    $daysoff->save();
  
    $response = [
        'success' => true,
        'message' => 'succès'
    ];

    return response()->json($response, 200);

   }

   public function get_days_off(){

    $daysoff = Daysoff::latest()->get();

    return $daysoff;

   }

   public function delete_daysoff($id){

    $daysoff = Daysoff::find($id);

    $daysoff->delete();
    
   }
}
