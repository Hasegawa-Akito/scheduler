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
Vue.component('room-login', require('./components/RoomLoginComponent.vue').default);
Vue.component('user-login', require('./components/UserLoginComponent.vue').default);
Vue.component('addition', require('./components/AdditionComponent.vue').default);
Vue.component('edit', require('./components/EditSchedule.vue').default);
Vue.component('calendar', require('./components/Calendar.vue').default);





/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//datepickerのコンポーネントをlocalに作る必要がある
 import Datepicker from 'vuejs-datepicker';
 //timepicker
 import VueTimepicker from 'vue2-timepicker/src/vue-timepicker.vue'

//datepickerのコンポーネントを使うのに必要
const app = new Vue({
    el: '#app',
    components: {
       'vue-timepicker': VueTimepicker,
        Datepicker,
    },
    
    
});
