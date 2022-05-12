@extends('layout')
@section('title', 'タイムスケジュール管理')
@section('loc-css')
<link rel="stylesheet" href="{{asset('css/timetable.css')}}">
@endsection
@section('her-css')
<link rel="stylesheet" href="{{secure_asset('css/timetable.css')}}">
@endsection

@section('content')

        <div class="member_list">
            <form class="member_select" action="{{url('/timetable/'.$user_id.'/'.$room_id)}}" method="post" autocomplete='off'>
            @csrf
                {!!$member_btn_html!!}
            </form>
        </div>
    
        <div class="row">
            <form  action="{{url('/timetable/'.$view_user_id.'/'.$room_id)}}" method="post" autocomplete='off'>
            @csrf
                <div class="form-group row form">
                    <div class="lavel">
                        <label for="datepicker" class="ml-4 col-form-label lavel"><h5>日付の選択</h5></label>
                    </div>
                    <div class="col-md-6 date"  id="date_picker">
                        
                        <calendar
                            :date="{{json_encode($date)}}"
                        ></calendar>
                    </div>
                    <div class="submit">
                        <input type="submit" name="submit" value="閲覧" class="submit ml-2">
                    </div>
                    
                </div>
                
            </form>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mb30">
                <h2>タイムテーブル</h2>
            </div>
            <div class="table-responsive">
                <table class="timetable table table-striped ">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" colspan="2">{{$view_username}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {!!$timetable_html!!}

                    </tbody>
                </table>
        </div>
            
@endsection

