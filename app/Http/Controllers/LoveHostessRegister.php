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
        $hostess=new Hostess;
        $hostess->name=$request->name;
        $hostess->grade=$request->grade;
        $hostess->academy=$request->academy;
        $hostess->tele=$request->tele;
        $hostess->time=$request->time;
        if($hostess->save())
        return response()->json([
            'err_code' => 0,
            'err_msg' => '',
        ]);
        else return response()->json([
            'err_code' => -1,
            'err_msg' => '报名失败请稍后重试哦！',
        ]);
        
    }
}