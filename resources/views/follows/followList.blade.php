@extends('layouts.login')

@section('content')
　<div class="follow_list">Follow List</div>

  <div class="follow_icon">
    @foreach ($followImg as $followImg)
        <div class="icon follow-img">
          <a href="{{ $followImg->id }}/profile"><img class="img posts_img" src="images/{{ $followImg->images }}"></a>
        </div>
    @endforeach
  </div>

  <div class="follow_post">
    <div class='table table-hover'>
      @foreach ($followList as $followList)
        <div class="posts_table">

         <div class="posts_left">
            <div class="icon"><a href="{{ $followList->user_id }}/profile">
              <img class="img posts_img" src="images/{{ $followList->images }}"></a></div>
         </div>

         <div class="posts_right">
           <div class="posts_flex flex-grow">
              <div class="username color">{{ $followList->username }}</div>
              <div class="created_at color">{{ $followList->created_at }}</div>
           </div>

          <div class="posts color">{{ $followList->posts }}</div>
         </div>

        </div>
      @endforeach
    </div>
  </div>

@endsection
