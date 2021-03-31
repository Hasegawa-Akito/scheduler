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
    :html="{{json_encode($announce_html)}}"
    ></announce>


@endsection
