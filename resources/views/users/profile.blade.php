@extends('layouts.login')

@section('content')
  <div class="profile_info">
    @foreach ($profile as $profile)

    <div class="profile_icon">
        <img class="img posts_img" src="{{ asset('images/'. $profile->images) }}">
      </div>

      <div class="main">
        <div class="profile_name">Name</div>
        <div class="profile_bio">Bio</div>
      </div>

      <div class="paragraph">
        <div class="profile_name">{{$profile->username}}</div>
        <div class="profile_bio">{{$profile->bio}}</div>
      </div>
    @endforeach

  </div>


  <div class="profile_post">
    <div class='table table-hover'>
      @foreach ($profileUser as $profileUser)
        <div class="posts_table">

         <div class="posts_left">
            <div class="icon"><img class="img posts_img" src="{{ asset('images/'. $profileUser->images) }}"></div>
         </div>

         <div class="posts_right">
           <div class="posts_flex flex-grow">
              <div class="username color">{{ $profileUser->username }}</div>
              <div class="created_at color">{{ $profileUser->created_at }}</div>
           </div>

          <div class="posts color">{{ $profileUser->posts }}</div>
         </div>

        </div>
      @endforeach
    </div>
  </div>
@endsection
