<template>
<div class="main">
    <form class="form-signin mt-5" v-bind:action="form_url" method="post" autocomplete='off'>
        <div class="text-right mb-5">
            <button type="button" name="menu" class="btn btn-outline-info white" v-on:click="value_change" v-bind:value="value">{{menu}}</button>
        </div>
        <input type="hidden" name="_token" v-bind:value="csrf" >

        <div class="text-center mb-3">
            <img class="mb-4 icon" v-bind:src="icon_url" alt="icon" width="100" height="100">
        </div>


        <div class="form-label-group">
            <label >room name</label>
            <input type="text" name="room_name" v-model="room_name" v-on:change="room_confirm" class="form-control" placeholder="room name" required autofocus>
            <p class="message">{{message}}</p>
        </div>

        <div class="form-label-group mt-2">
            <label for="inputPassword">Password</label>
            <input type="password" name="password" v-model="password" id="inputPassword" class="form-control" placeholder="Password" required>
        </div>

        <button class="mt-5 btn btn-lg btn-primary btn-block" onclick="submit();" v-bind:class="class_name" type="button">{{type}}</button>
        <p class="mt-5 mb-3 text-muted text-center">{{page}}</p>
    </form>
</div>
</template>

<script>
//vueでaxiosを使えるようにする
import axios from 'axios'


    export default {
        props: {
            api_url:{
                type:String,
                required:true
            },
            login_url:{
                type:String,
                required:true
            },
            create_url:{
                type:String,
                required:true
            },
            icon_url:{
                type:String,
                required:true
            },
            csrf:{
                type:String,
                required:true
            },
            message:{
                type:String,
                required:true
            },
            
        },
        data(){
            return{
                form_url:this.login_url,
                room_name:"",
                password:"",
                existing:false,
                valid:false,
                menu:"新規ルーム作成画面へ",
                value:"login",
                click:0,
                type:"ログイン",
                page:"ログインページ"
            };
        },
        methods:{
            room_confirm:function(){
                
                //console.log(this.room_name)
                axios.post(this.api_url,{room_name:this.room_name})
                .then((response)=>{
                    if(this.value=="create"){
                        if(response.data.existing){
                            this.message="すでに使用されています";
                            this.valid=false;
                        }else{
                            this.message=""
                            this.valid=true;
                        }
                    }
                    else{
                        this.message=""
                        this.valid=true;
                    }
                    
                })

            },
            value_change:function(){
                if(this.click%2==0){
                    this.form_url=this.create_url;
                    this.message="";
                    this.value="create";
                    this.menu="ルームログイン画面へ";
                    this.type="新規作成";
                    this.room_name="";
                    this.password="";
                    this.page="新規登録ページ"
                }
                else{
                    this.form_url=this.login_url;
                    this.message="";
                    this.value="login";
                    this.menu="新規ルーム作成画面へ";
                    this.type="ログイン";
                    this.room_name="";
                    this.password="";
                    this.page="ログインページ"
                }
                this.click+=1;
            },
            
        },
        computed:{
        //有効でないroom名または記入漏れの時は送信できないようにする
        class_name:function(){
            if((!this.valid)||(this.password==="")||(this.room_name==="")){
                    return "not_submit";
            }
            else{
                return "";
            }
            
        },
    },
        
    }
    
</script>