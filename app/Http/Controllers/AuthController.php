<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){

        //validator
        $validator = Validator::make($request->all(),[
          'name' => 'required',
          'email' => 'required|email',
          'number' => 'required',
          'password' => 'required',
          'c_password' => 'required|same:password'
        ]);
  
          if($validator->fails()){
              $response = [
                  'success' => false,
                  'message' => $validator->errors()
              ];
              return response()->json(
                  $response,400
              );
          }
  
          $input = $request->all();
          $input['password'] = bcrypt($input['password']);
          //$user = User::create($input);
  
         $user = new User();
         $user->name = $request->name;
         $user->email = $request->email;
         $user->number = $request->number;
         $user->role = 'user';
         $user->password = $input['password'];
         $user->save();

         Mail::to($user->email)->send(new WelcomeMail($request->name));
         Mail::to('romuald91303142@gmail.com')->send(new WelcomeMail($request->name));
         
          $success['token'] = $user->createToken('MyApp')->plainTextToken;
          $success['name'] = $user->name;
  
          $response = [
              'success' => true,
              'data' => $success,
              'message' => "User register successfully"
          ];
  
          return response()->json($response,200);
  
          }

          public function login(Request $request){

            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                 $user = $request->user();
                $success['token'] = $user->createToken('MyApp')->plainTextToken;
                $success['name'] = $user->name;
    
                $response = [
                    'success' => true,
                    'data' => $success,
                    'message' => "Login successfully"
                ];
                return response()->json($response, 200);
            }else {
                $response = [
                    'success' => false,
                    'message' => "Coordinate not found"
                ];
                return response()->json($response);
            }
                
        }

          public function login_admin(Request $request){

            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
                'role' => 'admin'
            ])) {
                 $user = $request->user();
                $success['token'] = $user->createToken('MyApp')->plainTextToken;
                $success['name'] = $user->name;
    
                $response = [
                    'success' => true,
                    'data' => $success,
                    'message' => "Login successfully"
                ];
                return response()->json($response, 200);
            }else {
                $response = [
                    'success' => false,
                    'message' => "Coordinate not found"
                ];
                return response()->json($response);
            }
                
        }

        public function get_auth_user(){

            $user = Auth::user();

            return $user;

        }

        public function edit_profil(Request $request){

            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email',
                // 'password' => 'required',
                // 'c_password' => 'required|same:password'
              ]);
        
                if($validator->fails() || $request->password != $request->c_password){
                    $response = [
                        'success' => false,
                        'message' => $validator->errors()
                    ];
                    return response()->json(
                        $response,200
                    );
                }

                // $input = $request->all();
                // $input['password'] = bcrypt($input['password']);
        
                $user_id = Auth::user()->id;
        
                $user = User::find( $user_id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->save();
        
                $response = [
                    'success' => true,
                    'message' => "successfully"
                ];
                return response()->json(
                    $response,
                    200
                );
        }


}
