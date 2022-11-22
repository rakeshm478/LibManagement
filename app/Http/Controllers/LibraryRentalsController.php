<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibraryRentals;
use App\Models\LibraryUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class LibraryRentalsController extends Controller
{
    function save(Request $req)
    {
         $validator = Validator::make($req->all(),[
         'book_name'=>'required|unique:library_books,book_id',
         'user_id'=>'required',
         'take_off_date'=>'required',
         'take_off_time'=>'required',
        
        ]);  
        
         if($validator->fails()){
            return[
                'status'=>409,"Result"=>$validator->messages()];

        }
        
        else{
        $libraryrentals=new LibraryRentals;
        $libraryrentals->book_name=$req->book_name;
        $libraryrentals->user_id=$req->user_id;
        $libraryrentals->take_off_date=$req->take_off_date;
        $libraryrentals->take_off_time=$req->take_off_time;
        $libraryrentals->return_date=$req->return_date;
        $libraryrentals->return_time=$req->return_time;
        $libraryrentals->damage_remarks=$req->damage_remarks;
   
        $result=$libraryrentals->save();
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
            'book_name'=>'required|unique:library_books,book_id',
            'user_id'=>'required',
            'take_off_date'=>'required',
            'take_off_time'=>'required',

          
        ]);  
        
         if($validator->fails()){
            return[
                'status'=>409,"Result"=>$validator->messages()];

        }
        
        else{
        
        $libraryrentals= LibraryRentals::find($id);
        $libraryrentals->book_name=$req->book_name;
        $libraryrentals->user_id=$req->user_id;
        $libraryrentals->take_off_date=$req->take_off_date;
        $libraryrentals->take_off_time=$req->take_off_time;
        $libraryrentals->return_date=$req->return_date;
        $libraryrentals->return_time=$req->return_time;
        $libraryrentals->damage_remarks=$req->damage_remarks;
        $result=$libraryrentals->save();
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
        // $libraryrentals=LibraryRentals::orderBy('created_at', 'desc')->paginate(10);
        $libraryrentals=DB::table('library_rentals')->join('library_user','library_rentals.user_id','=','library_user.library_user_id')->get();
        return response()->json([
            'status'=>200,
            'libraryrentals'=>$libraryrentals,
        ]);
}


function getById($id)
{

    $libraryrentals=LibraryRentals::find($id);
    $libraryusers=LibraryUser::find($libraryrentals->user_id);
    return response()->json([
        'status'=>200,
        'libraryrentals'=>$libraryrentals,
        "Borrowed BY"->$libraryusers
    ]);

     
}
}
