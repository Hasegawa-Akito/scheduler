<template>
    <form class="form-signin mt-5" v-bind:action="form_url" method="post" autocomplete='off'>
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
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        </div>

        <button class="mt-5 btn btn-lg btn-primary btn-block" onclick="submit();" v-bind:class="class_name" type="button">Verify / Create user</button>
        <p class="mt-5 mb-3 text-muted text-center">2021</p>
    </form>
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
            form_url:{
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
            
        },
        data(){
            return{
                room_name:"",
                existing:false,
                message:"",
                class_name:"not_submit"
                
            };
        },
        methods:{
            room_confirm:function(){
                console.log(this.room_name)
                axios.post(this.api_url,{room_name:this.room_name})
                .then((response)=>{
                    
                    if(response.data.existing){
                        this.message="すでに使用されています"
                        this.class_name="not_submit"

                    }else{
                        this.message=""
                        this.class_name=""
                    }
                    
                })

            },
            
        },
        
    }
    
</script>