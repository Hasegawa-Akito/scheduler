<template>
    <div>
        <div class="dark" v-bind:class="display"></div>
        <div class="announce">

            <button type="submit" class="btn btn-outline-primary ml-1" v-on:click="display_on">アナウンスをする</button>

            <div class="announce-form p-4" v-bind:class="display">
                <a class="peke" v-on:click="display_off">✖️</a>
                
                <form v-bind:action="url" method="post" autocomplete='off'>
                    <input type="hidden" name="_token" v-bind:value="csrf" >
                    <div class="mb-3">
                        <label class="form-label">アナウンス内容</label>
                        <input type="text" class="form-control" name="announce">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">アナウンスの種類</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">種類</div>
                                </div>
                                <select class="form-control" name="type">
                                    <option value="information">連絡</option>
                                    <option value="emergency">緊急</option>
                                    <option value="hurry">急ぎ</option>
                                    <option value="slow">ゆるい</option>
                                    <option value="anger">怒り</option>
                                    <option value="please">お願い</option>
                                </select>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary">アナウンス</button>
                </form>
            </div>
        </div>
        <div class="my-3 p-3 bg-white rounded shadow-sm" v-bind:class="controll">
            <h6 class="border-bottom pb-2 mb-0">アナウンスメント</h6>

            <!--Announceモデルで作ったhtmlを表示-->
            <div v-html="html">

            </div>
        </div>
    </div>

</template>

<script>


    export default {
        props: {
            url:{
                type:String,
                required:true
            },
            csrf:{
                type:String,
                required:true
            },
            html:{
                type:String,
                required:true
            }
        },
        data(){
            return {
                display:"display-off"
            };
        },
        computed:{
            controll:function(){
                if(this.display=="display-off"){
                    return "controll-on";
                }
                else{
                    return "controll-off";
                }
            }
        },
        methods:{
            display_on:function(){
                this.display="display-on";
            },
            display_off:function(){
                this.display="display-off";
            }
        }
    }
</script>