<template>
    <datepicker
        v-model="defaultDate"
        :format="DatePickerFormat"
        :language="ja"
        name="datepicker">
    </datepicker>
</template>

<script>
//timepicker
import VueTimepicker from 'vue2-timepicker/src/vue-timepicker.vue';
//datepicker
import Datepicker from 'vuejs-datepicker';
    export default {
        components: {
            'timepicker': VueTimepicker,
            'datepicker':Datepicker,
        },
        props: {
            date:{
                type:String,
                required:true
            },
        },
        data(){
            return{
                //デフォルトの日にちを受け取った日にちにする
                defaultDate: this.date,
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
        
        
        
    }
</script>