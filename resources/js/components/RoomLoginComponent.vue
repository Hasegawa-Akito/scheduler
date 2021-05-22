<template>
    <div>
        aaa
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
        },
        created(){
            axios.get(this.api_url)
            .then((response)=>{
                console.log(response.data)
            })
        }
    }
    
</script>