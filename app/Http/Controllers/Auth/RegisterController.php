<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'password_confirmation' => 'required|string|min:4|',
        ],
        [
             'username.required' => '入力必須です。',
             'username.required' => '入力必須です。',
             'username.max' => '225文字以下で入力してください。',
             'mail.required'  => '入力必須です。',
             'mail.max'  => '225文字以下で入力してください。',
             'mail.unique'  => '既に登録されたメールアドレスです。',
             'password.required'  => '入力必須です。',
             'password.min'  => '4文字以上で入力してください。',
             'password.confirmed'  => 'パスワードが一致しません。',
      ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)//101行目からから受け取ったデータを実行していく
    {
        return User::create([//$this->create($data)から受け取ったデータを登録する
            'username' => $data['username'],//usernameカラムに受け取った$dataのusernameを登録する
            'mail' => $data['mail'],//mailカラムに受け取った$dataのmailを登録する
            //bcrypt パスワードを安全に保管
            'password' => bcrypt($data['password']),//passwordカラムに受け取った$dataのpasswordを登録する
        ]);
    }

    public function register(Request $request){//入力されたデータを$requestに格納
        //isMethod 指定した文字列とHTTP動詞(post通信 or get通信)が一致するかを調べる
        if($request->isMethod('post')){
            $data = $request->input();//＄dataに入力情情報を格納する

            $validator = $this->validator($data);//validatorの実行結果を$validatorに格納
            if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)//ビュー側の$errorsにエラー文を格納
                        ->withInput();//セッション情報にもエラー文を格納
            } else{
            $this->create($data);//return User::createにデータを渡す
            return redirect('added')
                        ->with('data', $data['username']);//with('ビューで使う変数名', $ビューに渡す値)


            //$username = $request::all();
            //return view('added',compact('data'));
            }

        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
