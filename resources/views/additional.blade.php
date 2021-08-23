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
<!--
    <div class="form mt-5">
        <form method="post" action="{{url('/add')}}" autocomplete='off'>
        @csrf
            
            <div class="form-group row">
                <label for="datepicker" class="ml-4 col-form-label text-md-right">日付</label>
                <div class="col-md-6"  id="date_picker">
                    <Datepicker
                        v-model="defaultDate"
                        :format="DatePickerFormat"
                        :language="ja"
                        name="datepicker">
                    </Datepicker>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="datepicker" class="ml-4 col-form-label text-md-right">開始時刻</label>
                <div class="col-md-6"  id="date_picker_start">
                    <vue-timepicker
                        id="timepicker_start"
                        name="start_time"
                        placeholder="時間を入力"
                        input-class="form-control">
                    </vue-timepicker>
                </div>
            </div>
            <div class="form-group row">
                <label for="datepicker" class="ml-4 col-form-label text-md-right">終了時刻</label>
                <div class="col-md-6"  id="date_picker_finish">
                    <vue-timepicker
                        id="timepicker_finish"
                        name="finish_time"
                        placeholder="時間を入力"
                        input-class="form-control">
                    </vue-timepicker>
                </div>
            </div>

            <div class="mb-3 mt-4">
                <label class="form-label">key word　<a class="exp">exp(会議、ミーティング)</a></label>
                <input type="text" class="form-control" name="keyword">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">スケジュール内容</label>
                <input type="text" class="form-control" name="schedule">
            </div>
            <div class="mb-3">
                <label class="col-form-label text-md-right">色設定</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">色</div>
                    </div>
                    <select class="form-control" name="color">
                        <option value="gray">gray</option>
                        <option value="blue">blue</option>
                        <option value="red">red</option>
                        <option value="green">green</option>
                        <option value="yellow">yellow</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" value="submit">追加</button>
        </form>
    </div> 
    -->

@endsection