@extends('layout')
@section('title', '退出')

@section('content')

<form method="post" action="{{url('/leaving')}}">
@csrf
    <legend>roomを退出することができます。</br>ユーザーデータは消えてしまいます。</legend>
    <button type="submit" class="btn btn-primary">roomを退出する</button>
</form>
    


@endsection