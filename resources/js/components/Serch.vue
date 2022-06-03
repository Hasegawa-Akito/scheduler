<template>
    <div>
        <div class="form ml-3 mr-4" v-bind:class="controll">
            <div class="dark" v-bind:class="Display"></div>
                <input type="hidden" name="_token" v-bind:value="csrf" >
                <div class="form-row align-items-center mb-2">
                    <label class="form-label mt-1 ml-2">メンバー指定 </label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">メンバー</div>
                            </div>
                            <select class="form-control"  name="user_id" v-model="input_user_id">
                                <option value="%">全員</option>
                                <option v-for="(username, user_id) in user_infos" v-bind:value="user_id" v-bind:key="username">{{username}}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 子コンポーネントからの値受け取り -->
                <date-designate
                    @recDate="recDate"
                ></date-designate>

                <time-designate
                    @recTime="recTime"
                ></time-designate>

                <div class="keyword width"> 
                    <div class="mb-3 mt-4">
                        <label class="form-label">key word</label>
                        <input type="text" class="form-control" name="keyword" v-model="keyword">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" v-on:click="serch">検索</button>
        </div>

        <!-- モーダル部分 -->
        <div class="content serch_result" v-bind:class="Display">
            <a class="close pr-1 pt-1" v-on:click="display_off">✖️</a>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">日にち</th>
                    <th scope="col">作成者</th>
                    <th scope="col">内容</th>
                    <th scope="col">開始時間</th>
                    </tr>
                </thead>

                <!-- 検索結果を表示 -->
                <tbody v-if="serch_results.length > 0">
                    <tr v-for="serch_result in serch_results" :key="serch_result.username">
                        <th scope="row"><a :href="serch_result.timeline_url">{{ serch_result.date }}</a></th>
                        <td>{{ serch_result.username }}</td>
                        <td>{{ serch_result.schedule }}</td>
                        <td>{{ serch_result.time }}</td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td>予定が見つかりませんでした。</td>
                        <td></td>
                    </tr>
                </tbody>
                
            </table>
            

        </div>
        
    </div>
</template>

<script>
import DateDesignate from './DateDesignate.vue';

    //function dev_console(variable){
    //console.log(variable);
    //}
    export default {
  components: { DateDesignate },
        props: {
            html: {
                type:String,
                required:true
            },
            display: {
                type:String,
                required:true
            },
            url: {
                type:String,
                required:true
            },
            csrf: {
                type:String,
                required:true
            },
            user_infos: {
                type:Array,
                required:true
            },
            room_id: {
                type:String,
                required:true
            }
            
        },
        data(){
            return{
                Display: this.display,
                input_user_id: "%", //初期設定は全員を指す %
                inputYear: "%",
                inputMonth: "%",
                inputDay: "%",
                start_hour: "%",
                start_minute: "%",
                finish_hour: "%",
                finish_minute: "%",
                keyword: "",
                serch_results: []
            };
        },
        computed: {
            controll(){
                
                if(this.Display == "display_off"){
                    return "controll_on";
                }
                else{
                    return "controll_off";
                }
            }
        },
        
        methods: {
            //モーダルを閉じる
            display_off(){
                this.Display = "display_off";
            },

            //スケジュール検索apiを叩く
            async scheduleSerch(){

            },

            //子コンポーネントから日にちの値受け取り
            recDate(inputDate){
                this.inputYear = inputDate.year;
                this.inputMonth = inputDate.month;
                this.inputDay = inputDate.day;
            },
            //子コンポーネントから時間の値受け取り
            recTime(inputTime){
                this.start_hour = inputTime.start_hour;
                this.start_minute = inputTime.start_minute;
                this.finish_hour = inputTime.finish_hour;
                this.finish_minute = inputTime.finish_minute;
            },
            
            //予定検索
            async serch() {

                await axios.post(this.url, { year: this.inputYear,
                                             month: this.inputMonth,
                                             day: this.inputDay,
                                             start_hour: this.start_hour,
                                             start_minute: this.start_minute,
                                             finish_hour: this.finish_hour,
                                             finish_minute: this.finish_minute,
                                             keyword: this.keyword,
                                             user_id: this.input_user_id,
                                             room_id: this.room_id
                                            })
                .then((response) => {
                    this.serch_results = response.data;
                    this.Display = "display_on";

                })
                .catch((error) => {
                    this.value = error;
                })
                
            },
        },
    }
</script>