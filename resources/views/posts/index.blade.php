@extends('layouts.login')

@section('content')

{!! Form::open() !!}

<div class="posts_value">
  <img class="img posts_img post_img" src="images/{{ $user->images}}">
  {{ Form::label('') }}
  {{ Form::text('post',null,['class' => 'post_input', 'placeholder' => '何をつぶやこうか...?']) }}

  {{Form::submit('',['class' => 'posts_btn'])}}<img src="images/post.png">
</div>

{!! Form::close() !!}

<div class='container flex-grow'>
  <div class='table table-hover'>

    @foreach ($list as $list)
      <div class="posts_table">

        <div class="posts_left">
            <div class="icon"><img class="img posts_img" src="images/{{ $list->images }}"></div>
        </div>

        <div class="posts_right">
            <div class="posts_flex flex-grow">
              <div class="username color">{{ $list->username }}</div>
              <div class="created_at color">{{ $list->created_at }}</div>
            </div>

            <div class="posts color">{{ $list->posts }}</div>

            <div class="posts_edit">
            @if($user->id == $list->user_id)
              <a class="btn btn-primary modalopen" data-target="modal{{ $list->id }}"><img src="images/edit.png"></a>
              <a class="btn btn-danger modalopen" href="/post/{{ $list->id }}/top" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"><img src="images/trash.png"></a>
            @endif
            </div>
      </div>

    </div>

       <div id="modal{{ $list->id }}" class="modal_inner">
          {!! Form::open(['url' => '/update']) !!}
          <div class="form-group">
              {!! Form::hidden('id', $list->id) !!}
              {!! Form::input('textarea', 'upPost', $list->posts, ['required', 'class' => 'update_text', 'rows' => '5']) !!}
          </div>
          <button type="submit" onclick="form.submit()" class="update_btn"><img src="images/edit.png"></button>
          {!! Form::close() !!}
        </div>

    @endforeach

  </div>
</div>

@endsection
