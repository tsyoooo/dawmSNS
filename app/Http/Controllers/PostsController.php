<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    //投稿入力時のバリデーション
    protected function validator(array $data)
    {
        return Validator::make($data,[
        'post' => 'required|string|max:150',
        ],
        [
        'post.required' => '入力して下さいです。',
        'post.max' => '150文字以下で入力してください。',
        ]);
    }

    //  データベースに登録する
    public function create(Request $request)
    {
        $post = $request->input('post');//inputタグのname属性がPostと指定されていたところの値を$postに格納(=投稿内容)
        $user_id = Auth::id();
        \DB::table('posts')->insert([//データベースのpostテーブルに挿入↓
            'posts' => $post,//postカラムに$postを
            'user_id' => $user_id,//user_idカラムに$user_id(username)を
            'created_at' => now(),//デフォルトではnullになっている為、今の時間を自動で出力する
            'updated_at' => now()//デフォルトではnullになっている為、今の時間を自動で出力する
        ]);

        return redirect('/top');//引数の中で指定しているURLへ飛ぶ
    }


    //  topページに投稿内容、ユーザー名を表示する
    public function index(){
        $list = \DB::table('posts')->join('users','posts.user_id','=','users.id')//postsのuser_idとusersのidを結合
        ->select('users.images','users.username','posts.*')//usersのimages,usersのusername,postsの全カラムを取り出す
        ->get();//postsテーブルからすべてのレコード情報をゲットする

        $user = Auth::user();//現在ログインしているユーザー情報を取得し格納
        return view('posts.index',['user'=>$user],compact('user', 'list'));
    }


    //  投稿更新
    //indexからget送信で送られてきた値をupdateFormへ送る為のupdateFormメソッド
    /*public function updateForm($id)
    {
        $user = Auth::user();
        $post = \DB::table('posts')
            ->where('id', $id)
            ->first();
        return view('posts.updateForm', compact('post','user'));//変数、配列をcontrollerからviewに渡す
    }*/
    //updateFormから送られてきた値を更新しindexへ返すupdateメソッド
    public function update(Request $request)
    {
        $id = $request->input('id'); //input=取得する
        $up_post = $request->input('upPost');
        \DB::table('posts')
            ->where('id', $id)
            ->update(
                ['posts' => $up_post,'created_at' => now()]
            );

        return redirect('/top');
    }

    //  delete機能
    public function delete($id)
    {
        \DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }

    //ログアウトする
    public function logout(){
        Auth::logout();
        return view('/login');
    }
}
