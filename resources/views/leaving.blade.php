@extends('layout')
@section('title', '退出')

@section('content')


  <div class="bg-light p-5 rounded">
    <h1>現在のルームから退出</h1>
    <p class="lead">退出する際はパスワードを入力してください。現在のルームを退出した際、そのルームに保存されるご自身のデータは全て消去されます。</p>
    <form method="post" action="{{url('/leaving')}}">
    @csrf
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button type="submit" class="mt-3 btn btn-primary">roomを退出する</button>
    </form>
  </div>


    


@endsection