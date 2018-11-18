<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\FinalHostess;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoveHostessVote extends Controller
{
    public function info(Request $request)
    {
        $fhs = FinalHostess::all();
        $back = array();
        foreach ($fhs as $fh) {
            $information = array();
            $ary=array();
            $imgs=array();
            $imgs=json_decode($fh->imgsrc);
            foreach($imgs as $img){
                $ary[]=config('app.img') . '/' .$img;
            }
            $information['imgsrc'] = $ary;
            $information['name'] = $fh->name;
            $information['id'] = $fh->id;
            $information['declaration'] = $fh->declaration;
            $information['audiosrc'] = config('app.aud') . '/' . $fh->audiosrc;
            $information['votes'] = $fh->votes;
            $back[] = $information;
        }
        return response()->json([
            'err_code' => 0,
            'err_msg' => '',
            'info' => $back
        ]);
    }

    public function vote(Request $request)
    {
        $err_code = -1;
        $err_msg = '服务器累了，让它休息一下~';
        if (($request->id==null) || ($request->get('id')>11))
            return response()->json([
                'err_code' =>-2,
                'err_msg' => '非法操作！',
        ]);
        DB::transaction(function () use (&$err_code, &$err_msg, $request) {
            $final = FinalHostess::find($request->id);
            $session = $request->session()->all();
            $user = Vote::where('openid', $session['openid'])->latest('time')->first();
            $num=Vote::where([
                ['created_at','>',date('Y-m-d H:i:s',time()-60-1)],
                ['final_id','=',$request->id]
            ])->count();
            if ($num>=config('app.vote_num')){
                $err_code=3;
                $err_msg='当前时段投票人数较多，请稍后再来~';
            }
            else if (($user == null) || ($user->time < date('Y-m-d'))) {
                $final->votes()->create([
                    'openid' => $session['openid'],
                    'nickname' => $session['nickname'],
                    'headpic' => $session['headpic'],
                    'ip' => $request->ip(),
                    'time' => date('Y-m-d'),
                    'final_id' => $request->id,
                ]);
                $final->votes = $final->votes + 1;
                $final->save();
                $err_code = 0;
                $err_msg = '';
            } else {
                $err_code = 2;
                $err_msg = "每人每天只有一次投票机会哦~<br>您今天已投票，明天再来pick吧~";
            }
        }, 3);
        return response()->json([
            'err_code' => $err_code,
            'err_msg' => $err_msg,
        ]);
    }

}