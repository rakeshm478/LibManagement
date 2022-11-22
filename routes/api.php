<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryBooksController;
use App\Http\Controllers\LibraryRentalsController;
use App\Http\Controllers\LibraryUserController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::prefix('/admin')->namespace('admin')->group(function () {
    Route::post('/login',[UserController ::class,'login']);
    Route::post('/save',[UserController ::class,'save']);
    Route::post('/logout/{id}',[UserController ::class,'logout']);
    });


    Route::group(['middleware' => 'auth:sanctum'], function(){
       
        Route::prefix('/libUser')->namespace('libUser')->group(function () {
            Route::get('/getAll',[LibraryUserController ::class,'getAll']);
            Route::get('/getAll/{id}',[LibraryUserController ::class,'getById']);
            Route::post('/save',[LibraryUserController ::class,'save']);
            Route::post('/update/{id}',[LibraryUserController ::class,'update']);
            });
            
            Route::prefix('/librarybooks')->namespace('librarybooks')->group(function () {
            Route::get('/getAll',[LibraryBooksController ::class,'getAll']);
            Route::get('/getAll/{id}',[LibraryBooksController ::class,'getById']);
            Route::post('/save',[LibraryBooksController ::class,'save']);
            Route::post('/update/{id}',[LibraryBooksController ::class,'update']);
            });
            
            Route::prefix('/library')->namespace('libUser')->group(function () {
            Route::get('/getAll',[LibraryRentalsController ::class,'getAll']);
            Route::get('/getAll/{id}',[LibraryRentalsController ::class,'getById']);
            Route::post('/save',[LibraryRentalsController ::class,'save']);
            Route::post('/update/{id}',[LibraryRentalsController ::class,'update']);
            });
        });