<template>
    <div class="form mt-5">
        <form method="post" v-bind:action="form_url" autocomplete='off'>
        <input type="hidden" name="_token" v-bind:value="csrf" >
            <!-- 日付をカレンダーを使って入力 -->
            <div class="form-group row">
                <label for="datepicker" class="ml-4 col-form-label text-md-right">日付</label>
                <div class="col-md-6"  id="date_picker">
                    <datepicker
                        v-model="defaultDate"
                        :format="DatePickerFormat"
                        :language="ja"
                        name="datepicker">
                    </datepicker>
                </div>
            </div>
            
            <!-- timepicker -->
            <div class="form-group row">
                <label for="datepicker" class="ml-4 col-form-label text-md-right">開始時刻</label>
                <div class="col-md-6"  id="date_picker_start">
                    <timepicker
                        id="timepicker_start"
                        name="start_time"
                        v-model="start_time"
                        placeholder="時間を入力"
                        input-class="form-control">
                    </timepicker>
                    
                </div>
            </div>
            <div class="form-group row">
                <label for="datepicker" class="ml-4 col-form-label text-md-right">終了時刻</label>
                <div class="col-md-6"  id="date_picker_finish">
                    <timepicker
                        id="timepicker_finish"
                        name="finish_time"
                        v-model="finish_time"
                        placeholder="時間を入力"
                        input-class="form-control">
                    </timepicker>
                </div>
            </div>

            <div class="mb-3 mt-4">
                <label class="form-label">key word　<a class="exp">exp(会議、ミーティング)</a></label>
                <input type="text" class="form-control" name="keyword" v-model="key">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">スケジュール内容</label>
                <input type="text" maxlength='25' class="form-control" name="schedule" v-model="schedule">
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
            <button type="submit" class="btn btn-primary" value="submit" v-bind:class="class_name">追加</button>
        </form>
    </div>
</template>

<script>

//timepicker
import VueTimepicker from 'vue2-timepicker/src/vue-timepicker.vue';
//datepicker
import Datepicker from 'vuejs-datepicker';
    export default {
        components: {
            'timepicker': VueTimepicker,
            'datepicker': Datepicker,
        },
        props: {
            form_url:{
                type:String,
                required:true
            },
            csrf:{
                type:String,
                required:true
            },
            
        },
        data(){
            return{
                //v-modelで連携
                start_time: { "HH": "00", "mm": "00" },
                finish_time: { "HH": "00", "mm": "00" },
                schedule: null,
                key: null,
                defaultDate: new Date(),
                DatePickerFormat: 'yyyy-MM-dd',
                ja: {
                    language: 'Japanese',
                    months: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                    monthsAbbr: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                    days: ['日', '月', '火', '水', '木', '金', '土'],
                    rtl: false,
                    ymd: 'yyyy-MM-dd',
                    yearSuffix: '年'
                }
            }
        },
        computed: {
            //有効でないroom名または記入漏れの時は送信できないようにする
            class_name: function(){
                
                if((!this.schedule) || (!this.key)){
                        return "not_submit";
                }
                else{
                    var start_hour = parseInt(this.start_time.HH, 10);
                    var start_minute = parseInt(this.start_time.mm, 10);
                    var finish_hour = parseInt(this.finish_time.HH, 10);
                    var finish_minute = parseInt(this.finish_time.mm, 10);

                    var hour = start_hour - finish_hour;
                    var minute = start_minute - finish_minute;
                    
                    // 終了時間の方が開始時間より早い場合は送れない
                    if((hour > 0) || (hour == 0 && minute > 0)){
                        return "not_submit";
                    }

                    return "";
                }
                
            },
        }
        
    }
</script>