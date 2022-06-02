@extends('layout')
@section('title', '予定検索')
@section('loc-css')
<link rel="stylesheet" href="{{asset('css/serch.css')}}">
@endsection
@section('her-css')
<link rel="stylesheet" href="{{secure_asset('css/serch.css')}}">
@endsection
@section('content')
    <serch
    :html="{{json_encode($schedule_serch_html)}}"
    :display="{{json_encode($display)}}"
    :url="{{json_encode(url('/serch'))}}"
    :csrf="{{json_encode(csrf_token())}}"
    :user_infos="{{json_encode($user_infos)}}"
    :room_id="{{json_encode($room_id)}}"
    ></serch>
@endsection