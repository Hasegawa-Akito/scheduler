<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(app('env')=='local')<!-- envファイルのAPP_ENVの値-->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <script src="{{asset('js/app.js')}}" defer></script>
    @endif
    @if(app('env')=='production')<!--デプロイ時の環境設定でのAPP_ENVの値-->
    <link rel="stylesheet" href="{{secure_asset('css/app.css')}}">
    <link rel="stylesheet" href="{{secure_asset('css/login.css')}}">
    <script src="{{secure_asset('js/app.js')}}" defer></script>
    @endif
    <title>ルームログイン</title>
</head>
<body>

    <div id="app">
        

        <room-login
        :api_url="{{json_encode(asset('/getroom'))}}"
        :login_url="{{json_encode(url('/roomlogin'))}}"
        :create_url="{{json_encode(url('/roomcreate'))}}"
        :icon_url="{{json_encode(asset('picture/S_icon.jpg'))}}"
        :csrf="{{json_encode(csrf_token())}}"
        :message="{{json_encode($message)}}"
        ></room-login>

    </div>

    
  </body>
</html>