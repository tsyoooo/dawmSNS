@extends('layouts.login')

@section('content')


{!! Form::open(['class' => 'searchResult','url' => '/searchResult']) !!}

<div class="search-form">
{{ Form::text('search','',['class' => 'search','placeholder' => 'ユーザー名']) }}
{{ Form::submit('検索',['class' => 'searchbtn']) }}
</div>

<div class="keyword">
  検索ワード：{{$keyword}}
</div>

{!! Form::close() !!}

<div class="userlist-contents">
    @foreach ($result as $result)
    <div class="userlist">
      <div class="icon_name_left flex-grow">
        <div class="images"><img class="img flex-grow" src="images/{{$result->images}}"></div>
        <div class="username color flex-grow">{{$result->username}}</div>
      </div>

      <!--もしfollowsテーブルのフォローに自分のIDがなければ=フォローしていなければ-->
      <div class="btn_right flex-grow">
        @if(!in_array($result->id,array_column($followList,'follow')))
        <button class="followbtn red" type=“button” onclick="location.href='/follow/{{$result->id}}/searchResult'">フォローする</button>

        @else
        <button class="followbtn blue" type=“button” onclick="location.href='/unfollow/{{$result->id}}/searchResult'">フォローを外す</button>

        @endif
      </div>
    </div>
    @endforeach
</div>

@endsection
