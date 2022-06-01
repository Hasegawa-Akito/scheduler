<template>
    <div class="time width">
        <div class="form-row align-items-center mb-2">
            <label class="form-label mt-1 ml-2">日にち指定　</label>
            <div class="col-sm-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">年</div>
                    </div>
                    <select class="form-control" name="year" v-model="inputYear" v-on:change="sendDate">
                        <option value="%">指定なし</option>
                        <option v-for="year in years" v-bind:value="year" v-bind:key="year">{{year}}</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3 my-1 rep">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">月</div>
                    </div>
                    <select class="form-control" name="month" v-model="inputMonth" v-on:change="sendDate">
                        <option value="%">指定なし</option>
                        <option v-for="month in months" v-bind:value="month" v-bind:key="month">{{month}}</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3 my-1 rep">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">日</div>
                    </div>
                    <select class="form-control" name="day" v-model="inputDay" v-on:change="sendDate">
                        <option value="%">指定なし</option>
                        <option v-for="day in days" v-bind:value="day" v-bind:key="day">{{day}}</option>
                    </select>
                </div>
            </div>
        </div>
    
    </div>
</template>

<script>
    var year = [];
    for(var i = 2021; i <= 2030; i++){
        year.push(i);
    }
    //console.log(year);
    var month = [];
    for(var j = 1; j <= 12; j++){
        month.push(('0' + j).slice(-2));
    }
    var day = [];
    for(var k = 1; k <= 31; k++){
        day.push(('0' + k).slice(-2));
    }


    export default {
        
        data(){
            return { years: year,
                     months: month,
                     days: day,
                     inputYear: "%",
                     inputMonth: "%",
                     inputDay: "%"
                    };
        },
        methods: {
            //親コンポーネントへ送信用
            sendDate(){
                const inputDate = { year: this.inputYear,
                                    month: this.inputMonth, 
                                    day: this.inputDay
                                  };
                this.$emit('recDate', inputDate);
            },
        }
    }
</script>