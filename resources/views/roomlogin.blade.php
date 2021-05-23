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
    @if(app('env')=='heroku')<!--デプロイ時の環境設定でのAPP_ENVの値-->
    <link rel="stylesheet" href="{{secure_asset('css/app.css')}}">
    <link rel="stylesheet" href="{{secure_asset('css/login.css')}}">
    <script src="{{secure_asset('js/app.js')}}" defer></script>
    @endif
    <title>ルームログイン</title>
</head>
<body>
    <div id="app" class="main">
        <!--
        <form class="form-signin mt-5" action="{{url('/roomlogin')}}" method="post" autocomplete='off'>
        @csrf
            <div class="text-center mb-3">
                <img class="mb-4 icon" src="{{asset('picture/S_icon.jpg')}}" alt="icon" width="100" height="100">
            </div>

            <div class="form-label-group">
                <label >room name</label>
                <input type="text" name="room_name"  class="form-control" placeholder="room name" required autofocus>
            </div>

            <div class="form-label-group mt-2">
                <label for="inputPassword">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            </div>

            <button class="mt-5 btn btn-lg btn-primary btn-block" type="submit">Verify / Create user</button>
            <p class="mt-5 mb-3 text-muted text-center">&copy; 2021</p>
        </form>
        -->

        <room-login
        :api_url="{{json_encode(asset('/getdata'))}}"
        :form_url="{{json_encode(url('/roomlogin'))}}"
        :icon_url="{{json_encode(asset('picture/S_icon.jpg'))}}"
        :csrf="{{json_encode(csrf_token())}}"
        ></room-login>

    </div>

    
  </body>
</html>