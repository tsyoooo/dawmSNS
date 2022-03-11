<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <!--jQuery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <header>
        <div id="head">
                <div id="top">
                    <h1><a href="/top"><img src="{{ asset('images/main_logo.png') }}"></a></h1>
                </div>
                <div id="user">
                    <div class="flex">
                        <div>{{$AuthUser->username}}さん</div>
                        <div class="menu-trigger">
                        </div>
                        <img class="h-icon img" src="{{ asset('images/'. $AuthUser->images) }}">
                    </div>

                    <div class="gnavi">
                        <ul>
                            <li><a href="/top">HOME</a></li>
                            <li><a href="/profileEdit">プロフィール編集</a></li>
                            <li><a href="/logout">ログアウト</a></li>
                        </ul>
                    </div>
                </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div class="side-bar flex-grow">
            <div id="confirm">
                <p>{{$AuthUser->username}}さんの</p>

                <div class="side-flex">
                  <p>フォロー数</p>
                  <p>{{$followNumber}}名</p>
                </div>
                <p class="btn"><a class="list-btn" href="/followlist">フォローリスト</a></p>

                <div class="side-flex">
                  <p>フォロワー数</p>
                  <p>{{$followerNumber}}名</p>
                </div>
                <p class="btn"><a class="list-btn" href="/followerlist">フォロワーリスト</a></p>
            </div>

            <div class="searchBtn">
                <p class="btn searchBtn-top"><a class="searchBtn-text" href="/search">ユーザー検索</a></p>
            </div>

        </div>
    </div>
    <footer>
    </footer>
    <script src="{{ asset('js/dawn.js') }}"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>
