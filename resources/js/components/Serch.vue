<template>
    <div>
        <div class="form ml-3 mr-4" v-bind:class="controll">
            <div class="dark" v-bind:class="Display"></div>
            <form v-bind:action="url" method="post" autocomplete='off'>
                <input type="hidden" name="_token" v-bind:value="csrf" >
                <div class="form-row align-items-center mb-2">
                    <label class="form-label mt-1 ml-2">メンバー指定 </label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">メンバー</div>
                            </div>
                            <select class="form-control"  name="user_id">
                                <option value="%">全員</option>
                                <option v-for="(username,user_id) in user_infos" v-bind:value="user_id" v-bind:key="username">{{username}}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <date-designate></date-designate>

                <time-designate></time-designate>
                
                <div class="keyword width"> 
                    <div class="mb-3 mt-4">
                        <label class="form-label">key word</label>
                        <input type="text" class="form-control" name="keyword">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" value="submit">検索</button>
            </form>
        </div>
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
                <!--Scheduleモデルで作ったhtmlを表示 -->
                <tbody v-html="html">
                    
                </tbody>
            </table>
            

        </div>
    </div>
</template>

<script>

    //function dev_console(variable){
    //console.log(variable);
    //}
    export default {
        props: {
            html:{
                type:String,
                required:true
            },
            display:{
                type:String,
                required:true
            },
            url:{
                type:String,
                required:true
            },
            csrf:{
                type:String,
                required:true
            },
            user_infos:{
                type:Array,
                required:true
            }
            
        },
        data(){
            return{
                Display:this.display
            };
        },
        computed:{
            controll:function(){
    
                    //dev_console(this.user_infos);
                
                if(this.Display=="display_off"){
                    return "controll_on";
                }
                else{
                    return "controll_off";
                }
            }
        },
        
        methods:{
            display_off:function(){
                this.Display="display_off";
            },
        },
    }
</script>