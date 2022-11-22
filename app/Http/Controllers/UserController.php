<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    // 

    function login(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'user' => $user,
                'token' => $token,
            ];
        
             return response($response, 201);
    }

    function save(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required|unique:users,email',
            'password'=>'required',
              
           ]);  
         

        
        if($validator->fails())
        {
            return[
                'status'=>409,"Result"=>$validator->messages()];
        }
        else
        {
         $USER=new User;
         $USER->name=$request->name;
         $USER->email=$request->email;
         $USER->password= Hash::make($request->password);
         $result=$USER->save();
         if($result)
         {
            return[
                'status'=>200,"Result"=>"ADDED Succesfully"];
         }
         else
         {
            return["Result"=>"Cant add Record"];
         }
        }
    }

    function logout($id)
    {
        if(DB::table('personal_access_tokens')->where('tokenable_id',$id))
        {
            DB::table('personal_access_tokens')->where('tokenable_id',$id)->delete();
            return["Result"=>"Logout Succesfuly"];
        }
        else{
            return["Result"=>"Alredy Logout "];
        }
    }
}


