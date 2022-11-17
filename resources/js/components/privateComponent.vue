<template>
    <div>
        recived :{{recived.id}}
        auth :{{sender.id}}
        <div style="padding:15px" class="card">
            <div v-for="message in messages" :key="message.id">
                <div v-if="Auth.id == message.sender_id" style="float:left">{{message.message}}</div>
                <div v-else style="float:right">{{message.message}}</div>
            </div>
        </div>
        
        <input type="text" placeholder="Enter Message" v-model="message" class="form-control"><br>
        <button @click="sendMessage" class="btn btn-primary">Send</button><br>
    </div>
</template>

<script>
export default {
    name:"PrivateComponent",
    props:{
        sender:Object,
        recived:Object,
        Auth:Object,
        token:String
    },
    data(){
        return {
            message:null,
            messages:[]
        }
    },
    mounted(){
        this.getMessages();
        this.getRealTimeMessages();
    },
    methods:{
        sendMessage(){
            axios.post('/api/send/private/message',{message:this.message , sender_id:this.sender.id,recived_id:this.recived.id}).
            then(()=>{
                this.message = null
            });
        },
        getMessages(){
            axios.post('/api/messages/index',{'sender_id':this.sender.id , 'recived_id':this.recived.id}).then((response)=>{
                this.messages = response.data.messages
                console.log(response);
            })
        },
        getRealTimeMessages()
        {
            window.Echo.private('privateMessageChannel.1')
                .listen('PrivateMessageEvent',(e)=>{
                    console.log(e.data);
            })
        }

    }
    
}
</script>