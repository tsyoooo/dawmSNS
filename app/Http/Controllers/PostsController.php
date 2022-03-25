<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Validator;


class PostsController extends Controller
{
    //投稿入力時のバリデーション
    protected function validator(array $postData)
    {
        return Validator::make($postData,[
        'post' => 'required|string|max:150',
        ],
        [
        'post.required' => '入力して下さいです。',
        'post.max' => '150文字以下で入力してください。',
        ]);
    }

    //  データベースに登録する
    public function create(array $postData)
    {
        //dd($postData);
        $post = $postData['post'];//inputタグのname属性がPostと指定されていたところの値を$postに格納(=投稿内容)
        $user_id = Auth::id();
        \DB::table('posts')->insert([//データベースのpostテーブルに挿入(insert))↓
            'posts' => $post,//postカラムに$postを
            'user_id' => $user_id,//user_idカラムに$user_id(username)を
            'created_at' => now(),//デフォルトではnullになっている為、今の時間を自動で出力する
            'updated_at' => now()//デフォルトではnullになっている為、今の時間を自動で出力する
        ]);

        return redirect('/top');//引数の中で指定しているURLへ飛ぶ
    }

    //  投稿内容確認
    public function register(Request $request){//入力されたデータを$requestに格納

        $postData = $request->input();
        $postValidator = $this->validator($postData);//validatorの実行結果を$postValidatorに格納

        if ($postValidator->fails()) {
        return redirect('/top')
            ->withErrors($postValidator)//ビュー側の$errorsにエラー文を格納
            ->withInput();//セッション情報にもエラー文を格納
        } else{
        $this->create($postData);
        }
        return redirect('/top');
    }


    //  topページに投稿内容、ユーザー名を表示する
    public function index(){
        $list = \DB::table('posts')->join('users','posts.user_id','=','users.id')//postsのuser_idとusersのidを結合
        ->select('users.images','users.username','posts.*')//usersのimages,usersのusername,postsの全カラムを取り出す
        ->get();//postsテーブルからすべてのレコード情報をゲットする

        $user = Auth::user();//現在ログインしているユーザー情報を取得し格納
        return view('posts.index',['user'=>$user],compact('user', 'list'));
    }


    //更新入力時のバリデーション
    protected function upValidator(array $upPost)
    {
        return Validator::make($upPost,[
        'upPost' => 'required|string|max:150',
        ],
        [
        'upPost.required' => '入力して下さいです。',
        'upPost.max' => '150文字以下で入力してください。',
        ]);
    }

    public function update(array $upPost)
    {
        $id = $upPost['upId']; //input=取得する
        $up_post = $upPost['upPost'];
        \DB::table('posts')
            ->where('id', $id)
            ->update(
                ['posts' => $up_post,'updated_at' => now()]
            );
    }

    //  更新内容確認
    public function upRegister(Request $request){//入力されたデータを$requestに格納
        //dd($id);
        $upPost = $request->input();

        $upPostValidator = $this->upValidator($upPost);//validatorの実行結果を$postValidatorに格納

        //dd($upPost);

        if ($upPostValidator->fails()) {
        return redirect('/top')
            ->withErrors($upPostValidator)//ビュー側の$errorsにエラー文を格納
            ->withInput();//セッション情報にもエラー文を格納
        } else{
        $this->update($upPost);
        }
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
