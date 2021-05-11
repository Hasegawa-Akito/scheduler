<template>
    <div>
        <div class="flex-column flex-md-row justify-content-between header-btn mb-2">
            <button type="button" class="btn btn-outline-secondary menu-btn" v-on:click="display_change">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
                </svg>
            </button>
        </div>
        <transition>
        <div class="container flex-column flex-md-row justify-content-between" v-bind:class="display">
            <a class="py-2  d-md-inline-block" v-bind:href="timetable_url">予定表示</a>
            <a class="py-2  d-md-inline-block" v-bind:href="add_url">予定追加</a>
            <a class="py-2  d-md-inline-block" v-bind:href="announce_url">アナウンス</a>
            <a class="py-2  d-md-inline-block" v-bind:href="serch_url">予定検索</a>
            <a class="py-2  d-md-inline-block" v-bind:href="leaving_url">ルーム退出</a>
        </div>
        </transition>
    </div>
</template>

<script>

    export default {
        props: {
            timetable_url:{
                type:String,
                required:true
            },
            add_url:{
                type:String,
                required:true
            },
            announce_url:{
                type:String,
                required:true
            },
            serch_url:{
                type:String,
                required:true
            },
            leaving_url:{
                type:String,
                required:true
            },
        },
        data(){
            return{
                display:"menu-display-off",
                click:"on",
            };
        },
        methods:{
            display_change:function(){
                if(this.click=="on"){
                    this.display="menu-display-on"
                    this.click="off"
                }
                else if(this.click=="off"){
                    this.display="menu-display-off"
                    this.click="on"
                }

            }
        },
    }
</script>