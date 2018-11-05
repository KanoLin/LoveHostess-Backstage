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

Route::any('/testLogin',function(Request $request){
    $request->session()->put([
        'openid' => 'AHKDHFOAHIHFPOIWQHOIHFOEWFOISJDAmmF',
        'nickname' => 'test',
        'headpic' => '/123',
    ]);
    return 'login success';
})->middleware('web');

Route::any('/testLogout',function(Request $request){
    $request->session()->flush();
    return 'logout success';
})->middleware('web');


Route::post('/api/signUp','LoveHostessRegister@register')->middleware('validate');

Route::middleware('web')->group(function(){
    Route::post('/api/Info','LoveHostessVote@Info');
    Route::post('/api/Vote','LoveHostessVote@Vote')->middleware('login');
});
