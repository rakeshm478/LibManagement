<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibraryUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class LibraryUserController extends Controller
{
    //
    function save(Request $req)
    {
         $validator = Validator::make($req->all(),[
         'first_name'=>'required|max:191',
         'last_name'=>'required|max:191',
         'mobile_number'=>'required|unique:library_user,mobile_number',
         'email'=>'required|unique:library_user,email',
         'age'=>'required',
         'gender'=>'required',
         'city'=>'required',
           
        ]);  
        
         if($validator->fails()){
            return[
                'status'=>409,"Result"=>$validator->messages()];

        }
        
        else{
        $libraryusers=new LibraryUser;
        $libraryusers->first_name=$req->first_name;
        $libraryusers->last_name=$req->last_name;
        $libraryusers->mobile_number=$req->mobile_number;
        $libraryusers->email=$req->email;
        $libraryusers->age=$req->age;
        $libraryusers->gender=$req->gender;
        $libraryusers->city=$req->city;
        $result=$libraryusers->save();
        if($result){
            return[
                'status'=>200,"Result"=>"ADDED Succesfully"];
        }
        else{
            return["Result"=>"Cant add Record"];
        }
        }
    }

    function update(Request $req ,$id)
    {
        
         $validator = Validator::make($req->all(),[

            'first_name'=>'required|max:191',
            'last_name'=>'required|max:191',
            'mobile_number'=>'required|unique:library_user,mobile_number,$id,library_user_id',
            'email'=>'required|unique:library_user,email,$id,library_user_id',
            'age'=>'required',
            'gender'=>'required',
            'city'=>'required',

          
        ]);  
        
         if($validator->fails()){
            return[
                'status'=>409,"Result"=>$validator->messages()];

        }
        
        else{
        
        $libraryusers= LibraryUser::find($id);
        $libraryusers->first_name=$req->first_name;
        $libraryusers->last_name=$req->last_name;
        $libraryusers->mobile_number=$req->mobile_number;
        $libraryusers->email=$req->email;
        $libraryusers->age=$req->age;
        $libraryusers->gender=$req->gender;
        $libraryusers->city=$req->city;
        $result=$libraryusers->save();
        if($result){
            return[
                'status'=>200,"Result"=>"Updated Succesfully"];
        }
        else{
            return["Result"=>"Cant add Record"];
        }
        }
    }


    function getAll()
    {
        $libraryusers=LibraryUser::orderBy('created_at', 'desc')->paginate(10);
        return response()->json([
            'status'=>200,
            'libraryusers'=>$libraryusers,
        ]);
 
         
    }

    function getById($id)
    {
    
        $libraryusers=LibraryUser::find($id);
        return response()->json([
            'status'=>200,
            'libraryusers'=>$libraryusers,
        ]);
 
         
    }


}
