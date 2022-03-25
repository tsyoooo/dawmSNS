@extends('layouts.login')

@section('content')

<div class="edit_content">

    <div class="icon">
      <img class="img" src="images/{{ $user->images }}">
    </div>

    {!! Form::open(['files'=>true]) !!}

    <div class="edit">
      {{ Form::label('UserName') }}
      {{ Form::text('username',$user->username,['class' => 'input']) }}
    </div>

    <div class="error">
      @if ($errors->has('username'))
          {{$errors->first('username')}}
      @endif
    </div>


    <div class="edit">
      {{ Form::label('MailAdress') }}
      {{ Form::text('mail',$user->mail,['class' => 'input']) }}
    </div>

    <div class="error">
      @if ($errors->has('mail'))
          {{$errors->first('mail')}}
      @endif
    </div>


    <div class="edit">
      {{ Form::label('Password') }}
      {{ Form::input('password','password',$user->password,['class' => 'input','readonly']) }}
    </div>

    <div class="error">
      @if ($errors->has('Password'))
          {{$errors->first('Password')}}
      @endif
    </div>


    <div class="edit">
      {{ Form::label('NewPassword') }}
      {{ Form::text('NewPassword',"",['class' => 'input']) }}
    </div>

    <div class="error">
      @if ($errors->has('NewPassword'))
          {{$errors->first('NewPassword')}}
      @endif
    </div>


    <div class="edit">
      {{ Form::label('Bio') }}
      {{ Form::textarea('Bio',$user->bio,['class' => 'input']) }}
    </div>

    <div class="error">
      @if ($errors->has('Bio'))
          {{$errors->first('Bio')}}
      @endif
    </div>


    <div class="edit">
      {{ Form::label('Icon Images') }}
      <div class="file_wrapper">
        <label class="file">
        {{ Form::file('images',['class' => 'input']) }}
        ファイルを選択
        </label>
      </div>
      {{$user->images}}
    </div>

    <div class="error">
      @if ($errors->has('images'))
          {{$errors->first('images')}}
      @endif
    </div>


    <div class="submit_box">
    {{ Form::submit('更新',['class' => 'submit']) }}
    </div>

    {!! Form::close() !!}

</div>



@endsection
