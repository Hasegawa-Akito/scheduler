@extends('layout')
@section('title', 'タイムスケジュール追加')
@section('loc-css')
<link rel="stylesheet" href="{{asset('css/additional.css')}}">
@endsection
@section('her-css')
<link rel="stylesheet" href="{{secure_asset('css/additional.css')}}">
@endsection
@section('content')

        <addition
            :form_url="{{json_encode(url('/add'))}}"
            :csrf="{{json_encode(csrf_token())}}"
        ></addition>


@endsection