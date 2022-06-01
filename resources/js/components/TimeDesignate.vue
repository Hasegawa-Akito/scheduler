<template>
    <div class="time width">
        <div class="form-row align-items-center mb-1">
            <label class="form-label mt-1 ml-2">開始時間指定</label>
            <div class="col-sm-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">時</div>
                    </div>
                    <select class="form-control"  name="start_hour" v-model="start_hour" v-on:change="sendTime">
                        <option value="%">指定なし</option>
                        <option v-for="hour in hours" v-bind:value="hour" v-bind:key="hour">{{hour}}</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3 my-1 rep">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">分</div>
                    </div>
                    <select class="form-control"  name="start_minute" v-model="start_minute" v-on:change="sendTime">
                        <option value="%">指定なし</option>
                        <option v-for="minute in minutes" v-bind:value="minute" v-bind:key="minute">{{minute}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row align-items-center mb-2">
            <label class="form-label mt-1 ml-2">終了時間指定</label>
            <div class="col-sm-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">時</div>
                    </div>
                    <select class="form-control"  name="finish_hour" v-model="finish_hour" v-on:change="sendTime">
                        <option value="%">指定なし</option>
                        <option v-for="hour in hours" v-bind:value="hour" v-bind:key="hour">{{hour}}</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3 my-1 rep">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">分</div>
                    </div>
                    <select class="form-control"  name="finish_minute" v-model="finish_minute" v-on:change="sendTime">
                        <option value="%">指定なし</option>
                        <option v-for="minute in minutes" v-bind:value="minute" v-bind:key="minute">{{minute}}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var hour = [""];
    for(var i = 0; i <= 23; i++){
        hour.push(('0' + i).slice(-2));
    }
    //console.log(year);
    var minute = [""];
    for(var j = 0; j <= 59; j++){
        minute.push(('0' + j).slice(-2));
    }


    export default {
        
        data(){
            return { hours: hour,
                     minutes: minute,
                     start_hour: "%",
                     start_minute: "%",
                     finish_hour: "%",
                     finish_minute: "%"
                    };
        },
        methods: {
            sendTime(){
                const inputTime = { start_hour: this.start_hour,
                                    start_minute: this.start_minute, 
                                    finish_hour: this.finish_hour, 
                                    finish_minute: this.finish_minute
                                   };
                this.$emit('recTime', inputTime);
            }
        }
    }
</script>