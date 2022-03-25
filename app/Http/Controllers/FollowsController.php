<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;

class FollowsController extends Controller
{
    //フォローリスト表示
    public function followList(){
        $followList = \DB::table('users')
        ->join('follows','users.id','=','follows.follow')
        ->join('posts','users.id','=','posts.user_id')
        ->where('follower','=',Auth::id())//followerカラムとログイン者の数字が同じidを取り出す
        ->select('users.images','users.username','posts.*')
        ->get();
        //dd($followList);

        $followImg = \DB::table('users')
        ->join('follows','users.id','=','follows.follow')
        ->where('follower','=',Auth::id())//followerカラムとログイン者の数字が同じidを取り出す
        ->select('users.id','users.images')
        ->get();

        return view('follows.followList',['followList' => $followList,'followImg' => $followImg]);
    }

    //フォロー数の表示
    public function followNumber(){
        $followNumber = \DB::table('users')
        ->join('follows','users.id','=','follows.follow')
        ->join('posts','users.id','=','posts.user_id')
        ->where('follower','=',Auth::id())
        ->get()->count();
        //dd($followNumber);
    }

    //フォロワーリスト表示
    public function followerList(){
        $followerList = \DB::table('users')
        ->join('follows','users.id','=','follows.follower')
        ->join('posts','users.id','=','posts.user_id')
        ->where('follow','=',Auth::id())//followerカラムとログイン者の数字が同じidを取り出す
        ->select('users.id','users.images','users.username','posts.*')
        ->get();
        //dd($followerList);

        $followerImg = \DB::table('users')
        ->join('follows','users.id','=','follows.follower')
        ->where('follow','=',Auth::id())//followerカラムとログイン者の数字が同じidを取り出す
        ->select('users.id','users.images')
        ->get();
        //dd($followerImg);

        return view('follows.followerList',['followerList' => $followerList,'followerImg' => $followerImg]);
    }


}
