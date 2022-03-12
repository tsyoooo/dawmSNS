@extends('layouts.login')

@section('content')

<div id="search">
{!! Form::open(['url' => '/searchResult']) !!}

{{ Form::text('search',null,['class' => 'search','placeholder' => 'ユーザー名']) }}
{{ Form::submit('検索',['class' => 'searchbtn']) }}

{!! Form::close() !!}
</div>

<div class="userlist-contents">

    @foreach ($users as $users)
    <div class="userlist">
      <div class="icon_name_left flex-grow">
          <div class="images"><img class="img flex-grow" src="images/{{$users->images}}"></div>
          <div class="username color flex-grow">{{$users->username}}</div>
      </div>

      <div class="btn_right flex-grow">
          <!--もしfollowsテーブルのフォローに自分のIDがなければ-->
          @if(!in_array($users->id,array_column($followList,'follow')))
          <!--in_array 配列の中にあるか確認
          　　（検索値、配列
          array_column 配列の中の項目を指定(配列、キー)-->
          <button class="followbtn red" type=“button” onclick="location.href='/follow/{{$users->id}}/search'">フォローする</button>

          @else
          <button class="followbtn blue" type=“button” onclick="location.href='/unfollow/{{$users->id}}/search'">フォローを外す</button>
          @endif
      </div>

    </div>
    @endforeach
</div>

@endsection
