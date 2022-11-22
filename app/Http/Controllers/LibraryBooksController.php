<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibraryBooks;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


class LibraryBooksController extends Controller
{
    function save(Request $req)
    {
         $validator = Validator::make($req->all(),[
         'book_name'=>'required|unique:library_books,book_id',
         'author'=>'required',
         'cover_image'=>'required',
        ]);  
        
         if($validator->fails()){
            return[
                'status'=>409,"Result"=>$validator->messages()];

        }
        
        else{
        $librarybooks=new LibraryBooks;
        $librarybooks->book_name=$req->book_name;
        $librarybooks->author=$req->author;
        $librarybooks->cover_image=$req->cover_image;
        $result=$librarybooks->save();
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
            'author'=>'required',
            'cover_image'=>'required',

          
        ]);  
        
         if($validator->fails()){
            return[
                'status'=>409,"Result"=>$validator->messages()];

        }
        
        else{
        
        $librarybooks= LibraryBooks::find($id);
        $librarybooks->book_name=$req->book_name;
        $librarybooks->author=$req->author;
        $librarybooks->cover_image=$req->cover_image;
        $result=$librarybooks->save();
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
        $librarybooks=LibraryBooks::orderBy('created_at', 'desc')->paginate(10);
        return response()->json([
            'status'=>200,
            'librarybooks'=>$librarybooks,
        ]);
 
         
    }
    
    function getById($id)
    {
        $librarybooks=LibraryBooks::find($id);
        return response()->json([
            'status'=>200,
            'librarybooks'=>$librarybooks,
        ]);
 
         
    }

}
