/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('time-designate', require('./components/TimeDesignate.vue').default);
Vue.component('date-designate', require('./components/DateDesignate.vue').default);
Vue.component('announce', require('./components/Announce.vue').default);
Vue.component('removal-button', require('./components/RemovalButton.vue').default);
Vue.component('serch', require('./components/Serch.vue').default);
Vue.component('header-component', require('./components/HeaderComponent.vue').default);
Vue.component('leaving', require('./components/LeavingComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//datepickerのコンポーネントをlocalに作る必要がある
 import Datepicker from 'vuejs-datepicker';
 //timepicker
 import VueTimepicker from 'vue2-timepicker/src/vue-timepicker.vue'

const app = new Vue({
    el: '#app',
    components: {
       'vue-timepicker': VueTimepicker,
        Datepicker,
    },
    data: {
        //v-modelで連携
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
});
