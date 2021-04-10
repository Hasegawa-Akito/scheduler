@extends('layout')
@section('title', 'アナウンスメント')
@section('loc-css')
<link rel="stylesheet" href="{{asset('css/announce.css')}}">
@endsection
@section('her-css')
<link rel="stylesheet" href="{{secure_asset('css/announce.css')}}">
@endsection
@section('content')


    <announce
    :url="{{json_encode(url('/announce'))}}"
    :csrf="{{json_encode(csrf_token())}}"
    ></announce>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">アナウンスメント</h6>
        

        <!--Announceモデルで作ったhtmlを表示-->
        {!!$announce_html!!}
    </div>


@endsection
