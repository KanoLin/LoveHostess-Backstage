<?php

namespace App\Http\Middleware;

use Closure;
use Validator;
use App\Hostess;


class RequestValidate
{
    public function handle($request,Closure $next)
    {
        $validate=[
            'name'=>'bail|required|max:10',
            'grade'=>'bail|required|max:10',
            'academy'=>'bail|required',
            'tele'=>'bail|required|size:11',
            'time'=>'bail|required'
        ];
        $strname=[
            'name'=>'姓名',
            'grade'=>'年级',
            'academy'=>'学院',
            'tele'=>'手机',
            'time'=>'海选时间'
        ];
        $msg=[
            'required'=>':attribute是必须的哦！',
            'max'=>':attribute不能超过:max字符哦！',
            'size'=>':attribute长度应为:size哦！'
        ];

        $validator=Validator::make($request->all(),$validate,$strname,$msg);
        $errcode=0;
        $errmsg='';
        if ($validator->fails()){
            $errcode=1;
            foreach ($validator->errors()->all() as $err)
            $errmsg=$errmsg.$err."\n";
            return response()->json([
                'err_code'=>$errcode,
                'err_msg'=>$errmsg
            ]);
        }
        
        $hostess=Hostess::where('tele',$request->tele)->first();
        if ($hostess!=null)
            return response()->json([
                'err_code'=>1,
                'err_msg'=>'该手机号已经注册了哦！'
            ]);
        
        return $next($request);
    }
}