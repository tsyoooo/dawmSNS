<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;


class UsersController extends Controller
{
    //プロフィール編集画面へ遷移(共通部分のデータ)
    public function profileEdit(){
        $list = \DB::table('posts')->join('users','posts.user_id','=','users.id')//postsのuser_idとusersのidを結合
        ->select('users.images','users.username','posts.*')//usersのimages,usersのusername,postsの前カラムを取り出す
        ->get();//postsテーブルからすべてのレコード情報をゲットする

        $user = Auth::user();//現在ログインしているユーザー情報を取得し格納
        return view('users.profileEdit',['list'=>$list,'user'=>$user]);//['受け渡す先での変数名(list)'=>今回渡す変数($list)]
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255',
            'NewPassword' => 'nullable|min:4',
            'images' => 'file|image|mimes:jpeg,png,jpg,gif|max:50'
        ],
        [
            'username.required' => '入力必須です。',
            'username.max' => '225文字以下で入力してください。',
            'mail.required'  => '入力必須です。',
            'mail.max'  => '225文字以下で入力してください。',
            'mail.unique'  => '既に登録されたメールアドレスです。',
            'NewPassword.min'  => '4文字以上で入力してください。',
        ]);
    }

        /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function update(array $data,$images)//registerから受け取ったデータを実行していく
    {
        if(isset($images)){
        $file_name = $images->getClientOriginalName();//ファイルの名前を取得
        $path = $images->storeAs('images',$file_name,'public_uploads');//storeAs＝public/imagesに画像を保存する(保存場所、画像名、disks配列のkey)
        User::where('id', Auth::id())
                ->update([//更新
                'images' => $file_name,
                ]);
        }

        User::where('id', Auth::id())
                ->update([//更新
                'username' => $data['username'],
                'mail' => $data['mail'],
                'password' => bcrypt($data['NewPassword']),
                'bio' => $data['Bio'],
                ]);
    }

    public function register(Request $request){//入力されたデータを$requestに格納

        $data = $request->input();//＄dataに入力情報を格納する
        //dd($data);
        $images = $request->file('images');//file：登録した画像を取得
        //dd($images);
        $validator = $this->validator($data);//validatorの実行結果を$validatorに格納

        if ($validator->fails()) {
        return redirect('/profileEdit')
            ->withErrors($validator)//ビュー側の$errorsにエラー文を格納
            ->withInput();//セッション情報にもエラー文を格納
        } else{
        $this->update($data,$images);//return User::createにデータを渡す
        }
        return redirect('/profileEdit');
    }

    //検索ページ表示
    public function search(){
        $users = \DB::table('users')
                ->where('id','!=',Auth::id())
                ->select('users.id','users.images','users.username')
                ->get();

        $followList = \DB::table('follows')
                    ->where('follower',Auth::id())
                    ->get()
                    ->toArray();//toArray:リストから配列を作成します。

        return view('users.search',['users'=>$users,'followList'=>$followList]);
    }

    //検索結果ページ表示
    public function searchResult(Request $request){
        $keyword = $request->input('search');//inputの引数は受け取るname属性
        $result = \DB::table('users')->where('username', 'LIKE', "%$keyword%")->get();
        $followList = \DB::table('follows')->where('follower',Auth::id())->get()->toArray();

        return view('users.searchResult',['keyword' => $keyword,'result'=>$result,'followList'=>$followList]);
    }

    //フォローする
    public function follow($id){
        //dd($id);
        $follows = $id;
        //dd($follows);
        $my_id = Auth::id();//自分のidを取得

        \DB::table('follows')->insert([//データベースのfollowsテーブルに挿入↓
        'follow' => $follows,//follow'カラムに$followsを
        'follower' => $my_id,//follow'カラムに$followsを
        'created_at' => now(),//今の時間を自動で出力する
        ]);

        return back();//return back()の時にはget通信になる
    }

    //フォローを外す
    public function unfollow($id){
        \DB::table('follows')
            ->where('follow', $id)
            ->where('follower',Auth::id())
            ->delete();

        return back();
    }

    //プロフィール画面表示
    public function profile($id){
        $profileUser = \DB::table('users')
        ->join('posts','users.id','=','posts.user_id')
        ->where('user_id',$id)
        ->select('users.id','users.images','users.username','users.bio','posts.*')
        ->get();
        //dd($profileUser);

        $profile = \DB::table('users')
        ->where('id',$id)
        ->select('users.id','users.images','users.username','users.bio')
        ->first();

        $followBtn = \DB::table('follows')->where('follower',Auth::id())->get()->toArray();

        return view('users.profile',['profileUser'=>$profileUser, 'profile'=>$profile, 'followBtn'=>$followBtn]);
    }

}
