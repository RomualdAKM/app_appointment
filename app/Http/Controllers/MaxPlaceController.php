<?php

namespace App\Http\Controllers;

use App\Models\MaxPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaxPlaceController extends Controller
{
    public function get_max_place($id){

        $maxplace = MaxPlace::find($id);
        
        return $maxplace;

    }
    public function get_max_places(){

        $maxplaces = MaxPlace::all();
        
        return $maxplaces;

    }

    public function edit_max_place(Request $request,$id){

       // dd($request->all());

        $validator = Validator::make($request->all(), [
            'number' => 'required',
        ]);
    
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
    
        $maxplace = MaxPlace::find($id);  
        $maxplace->number = $request->number;
        $maxplace->save();
      
        $response = [
            'success' => true,
            'message' => 'succès'
        ];
    
        return response()->json($response, 200);
    
    }
}
