@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<div id="login">
<p>DAWNSNSへようこそ</p>

<div class="form">
{{ Form::label('e-mail') }}
{{ Form::text('mail',null,['class' => 'input input_bottom" name="" value="">']) }}

<div class="error">
@if ($errors->has('mail'))<!--リクエストに値が存在するかを判定する-->
    {{$errors->first('mail')}}
@endif
</div>

{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}

<div class="error">
@if ($errors->has('password'))
    {{$errors->first('password')}}
@endif
</div>

<div class="submit_box">
{{ Form::submit('LOGIN',['class' => 'submit'])}}
</div>

</div>

<p class="link"><a href="/register">新規ユーザーの方はこちら</a></p>
</div>

{!! Form::close() !!}

@endsection
