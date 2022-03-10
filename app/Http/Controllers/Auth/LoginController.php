<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    //ログインする
    public function login(Request $request){//入力されたデータを$requestに格納
        //isMethod 指定した文字列とHTTP動詞(post通信 or get通信)が一致するかを調べる
        if($request->isMethod('post')){

            $data=$request->only('mail','password','username');
            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            if(Auth::attempt($data)){//attempt:認証が成功すればtrueを返します。失敗時はfalseを返します。
                return redirect('/top');
                        //->with('data', $data['username']);//with('ビューで使う変数名', $ビューに渡す値)
            }
        }
        return view("auth.login");
    }

    //ログアウトする
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
        //Auth::guard($this->getGuard())->logout();

        //return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : 'login');
    }
}
