@extends('layouts.login')

@section('content')
  <div class="follow_list">Follower List</div>

  <div class="follow_icon">
    @foreach ($followerImg as $followerImg)
        <div class="icon follow-img">
          <a href="{{ $followerImg->id }}/profile"><img class="img posts_img" src="images/{{ $followerImg->images }}"></a>
        </div>
    @endforeach
  </div>

  <div class="follow_post">
    <div class='table table-hover'>
      @foreach ($followerList as $followerList)
        <div class="posts_table">

         <div class="posts_left">
            <div class="icon"><img class="img posts_img" src="images/{{ $followerList->images }}"></div>
         </div>

         <div class="posts_right">
           <div class="posts_flex flex-grow">
              <div class="username color">{{ $followerList->username }}</div>
              <div class="created_at color">{{ $followerList->created_at }}</div>
           </div>

          <div class="posts color">{{ $followerList->posts }}</div>
         </div>

        </div>
      @endforeach
    </div>
  </div>
@endsection
