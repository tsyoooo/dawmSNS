@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<div id="login">
<h2>新規ユーザー登録</h2>



<div class="form">
{{ Form::label('UserName') }}
{{ Form::text('username',null,['class' => 'input', 'placeholder' => 'dawntown']) }}

<div class="error">
@if ($errors->has('username'))
    {{$errors->first('username')}}
@endif
</div>

{{ Form::label('MailAdress') }}
{{ Form::text('mail',null,['class' => 'input', 'placeholder' => 'dawn@dawn.jp']) }}

<div class="error">
@if ($errors->has('mail'))
    {{$errors->first('mail')}}
@endif
</div>

{{ Form::label('Password') }}
{{ Form::text('password',null,['class' => 'input']) }}

<div class="error">
@if ($errors->has('password'))
    {{$errors->first('password')}}
@endif
</div>

{{ Form::label('Password confirm') }}
{{ Form::text('password_confirmation',null,['class' => 'input']) }}

<div class="submit_box">
{{ Form::submit('REGISTER',['class' => 'submit']) }}
</div>

</div>

<p class="link"><a href="/login">ログイン画面へ戻る</a></p>
</div>

{!! Form::close() !!}


@endsection
