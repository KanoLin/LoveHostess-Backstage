<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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

Route::any('/date', function () {
    return date('Y-m-d');
});

Route::any('/testLogin', function (Request $request) {
    $request->session()->put([
        'openid' => 'AHKDHFOAHIHFPOIWQHOIHFOEWFOISJDAmmF',
        'nickname' => 'test',
        'headpic' => '/123',
    ]);
    return 'login success';
})->middleware('web');

Route::any('/testLogout', function (Request $request) {
    $request->session()->flush();
    return 'logout success';
})->middleware('web');


Route::post('/api/signUp', 'LoveHostessRegister@register')->middleware('validate');

Route::post('/api/checkLogin', function () {
    return response()->json([
        'err_code' => 0,
        'err_msg' => ''
    ]);
})->middleware('login');
Route::middleware('web')->group(function () {
    Route::post('/api/Info', 'LoveHostessVote@Info');
    Route::post('/api/Vote', 'LoveHostessVote@Vote')->middleware('login');
});

Route::get('/img/{img_name}', function ($name) {
    return response()->file(storage_path('app/public') . '/img/' . $name, ['Content-type' => 'image/png']);
});


Route::get('/aud/{aud_name}', function ($name) {
    $size = filesize(storage_path('app/public') . '/aud/' . $name);
    return response()->file(storage_path('app/public') . '/aud/' . $name, [
        'Content-type' => 'audio/mp3',
        'Content-Disposition' => 'inline;filename="' . $name . '"',
        'Accept-Ranges' => '0-' . ($size - 1),
        'Content-Length' => $size,
    ]);
});