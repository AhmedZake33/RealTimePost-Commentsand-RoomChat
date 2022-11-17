<template>
    <div>
        <ul>
            <li v-for="message in messages" :key="message.id">
                <span v-if="message.user_id == auth" style="float:right">{{message.message}}</span>
                <span v-else style="float:left">{{message.message}}</span>
            </li>
        </ul> 
        <br />
        <div>
           
            <textarea placeholder="Enter Message" v-model="message" class="form-control" required=""></textarea>
            <br>
            <button @click="SendMessage" class="btn btn-danger" >Send</button><br>
        </div>
    </div>
</template>

<script>
    export default {
        name:"UserComponent",
        props:{
            user:Number,
            auth:Number
        },
        created(){
            axios.get('/api/message').then((response) => {
                this.messages = response.data;
            })
        },
         mounted(){
           this.getNotifications();
        //    this.messages = await SendMessage();
            
        },
        data(){
            return {
                messages:[],
                message:null
            }
        },
         methods:{
            getNotifications(){
               window.Echo.channel('MessageChannel')
                .listen('SendMessages',(e) =>{
                    this.messages.push(e.message)
                    console.log('test');
            })
            },
            SendMessage(){
               this.axios.post('api/sendMessage',{message:this.message}).then(
                this.message = null
               );
            }
        }
    }
</script>

<style scoped>

li {
    width: 100%;
    display: table;
    background-color: red;
    margin-bottom: 10px;
    color: white;
    padding: 9px;
    font-weight: bold;
}

</style>