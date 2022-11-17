<template>
    <div>
        this is user {{user}}
       
    </div>
</template>

<script>
    export default {
        name:"UserComponent",
        props:{
            user:Number,
            default:null
        },
        mounted(){
            console.log('test');
            window.Echo.private('message.'+this.user)
                .listen('NewMessageReceived',(e) =>{
                    console.log(e.content);
                    alert();
            })
        },
        data(){
            return {

            }
        },
    }
</script>