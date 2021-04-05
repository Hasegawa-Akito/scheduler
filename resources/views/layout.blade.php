<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--assetを用いる場合リンクにhttpとhttpsが混在してしまい本番環境ではブラウザでブロックされてしまう-->
        @if(app('env')=='local')<!-- envファイルのAPP_ENVの値-->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/layout.css')}}">
        @yield('loc-css')
        @yield('loc-js')
        <script src="{{asset('js/app.js')}}" defer></script>
        @endif
        @if(app('env')=='heroku')<!--デプロイ時の環境設定でのAPP_ENVの値-->
        <link rel="stylesheet" href="{{secure_asset('css/app.css')}}">
        <link rel="stylesheet" href="{{secure_asset('css/layout.css')}}">
        @yield('her-css')
        @yield('her-js')
        <script src="{{secure_asset('js/app.js')}}" defer></script>
        @endif
        <title>@yield('title')</title>
    </head>

    <body>
        <div id="app">  
            <header class="site-header sticky-top py-3 mb-3">
                <header-component
                :timetable_url="{{json_encode(asset('/timetable/'.$view_user_id.'/'.$room_id))}}"
                :add_url="{{json_encode(asset('/add'))}}"
                :announce_url="{{json_encode(asset('/announce'))}}"
                :serch_url="{{json_encode(asset('/serch'))}}"
                :howto_url="{{json_encode('#')}}"
                :leaving_url="{{json_encode(asset('/leaving'))}}"
                ></header-component>
            </header>
            <div class="container">
                @yield('content')
            </div>
        </div>
    </body>
</html>