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
            $information['imgsrc'] = config('app.img') . '/' . $fh->imgsrc;
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
        $err_code = 1;
        $err_msg = '服务器累了，让它休息一下~';
        DB::transaction(function () use (&$err_code, &$err_msg, $request) {
            $final = FinalHostess::find($request->id)->first();
            $session = $request->session()->all();
            $user = Vote::where('openid', $session['openid'])->latest('time')->first();
            if (($user == null) || ($user->time < date('Y-m-d'))) {
                $final->votes()->create([
                    'openid' => $session['openid'],
                    'nickname' => $session['nickname'],
                    'headpic' => $session['headpic'],
                    'time' => date('Y-m-d'),
                ]);
                $final->votes = $final->votes + 1;
                $final->save();
                $err_code = 0;
                $err_msg = '';
            } else {
                $err_code = 2;
                $err_msg = '今天已经投过票了哦~';
            }
        }, 3);
        return response()->json([
            'err_code' => $err_code,
            'err_msg' => $err_msg,
        ]);
    }

}