<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('main');
});*/

Route::get('/{any}', function () {
    return view('main');
})->where('any', '.*');

/*Route::middleware("isAdmin")->get("/admin/home",function (){
   return view("admin.dashboard");
})->name("admin.home");*/