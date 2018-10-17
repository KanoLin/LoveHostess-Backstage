<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Hostess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoveHostessRegister extends Controller
{
    public function register(Request $request)
    {
        DB::beginTransaction();
        $hostess = Hostess::where('tele', $request->tele)->first();
        if ($hostess != null){
            DB::rollBack();
            return response()->json([
            'err_code' => 1,
            'err_msg' => '该手机号已经注册了哦！'
        ]);}
        $hostess = new Hostess;
        $hostess->name = $request->name;
        $hostess->grade = $request->grade;
        $hostess->academy = $request->academy;
        $hostess->tele = $request->tele;
        $hostess->time = $request->time;
        if ($hostess->save()){
            DB::commit();
            return response()->json([
            'err_code' => 0,
            'err_msg' => '',
        ]);}
        else {
            DB::rollBack();
            return response()->json([
            'err_code' => -1,
            'err_msg' => '报名失败请稍后重试哦！',
        ]);}

    }
}