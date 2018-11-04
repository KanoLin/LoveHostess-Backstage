<?php
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});

Route::any('/date',functIon() {
    return date('Y-m-d');
});

Route::any('/testLogin','LoveHostessVote@testLogin')->middleware('web');
// Route::any('/testLogout','LoveHostessVote@testLogout')->middleware('web');
Route::any('/testLogout',function(Request $request){
    $request->session()->flush();
    return 'success';
})->middleware('web');


Route::post('/api/signUp','LoveHostessRegister@register')->middleware('validate');

Route::middleware('web')->group(function(){
    Route::post('/api/Info','LoveHostessVote@Info');
    Route::post('/api/Vote','LoveHostessVote@Vote')->middleware('login');
});
