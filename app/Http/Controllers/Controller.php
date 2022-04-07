<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use View;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     public function __construct(){
        //ログインしていない場合は、ログイン画面へ移動する
        $this->middleware('auth');
        // 全てのページで共通に使える情報をビューに送る
        $this->middleware(function ($request, $next) {

            //ログインユーザー情報の取得
            $AuthUser = Auth::user();
            $list = \DB::table('posts')->join('users','posts.user_id','=','users.id')
            ->select('users.images','users.username','posts.*')
            ->get();
            //dd($user);


            //フォロー数の表示
            $followNumber = \DB::table('users')
            ->join('follows','users.id','=','follows.follow')
            ->where('follower','=',Auth::id())
            ->get()->count();
            //dd($followNumber);

            $followerNumber = \DB::table('users')
            ->join('follows','users.id','=','follows.follower')
            ->where('follow','=',Auth::id())
            ->get()->count();
            //dd($followerNumber);

            View::share('AuthUser', $AuthUser);
            View::share('list', $list);
            View::share('followNumber', $followNumber);
            View::share('followerNumber', $followerNumber);

            return $next($request);
        });
    }

}
