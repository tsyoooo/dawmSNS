@extends('layouts.logout')

@section('content')

<div id="login">
<div id="clear">
<p><span>{{Session::get('data')}}さん</span><br><!--セッションに保存されている情報を呼び出す-->
ようこそ！DAWNSNSへ！</p>

<p>ユーザー登録が完了しました。<br>
さっそく、ログインをしてみましょう。</p>

<p class="btn"><a href="login" class="submit">ログイン画面へ</a></p>
</div>
</div>

@endsection
