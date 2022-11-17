<template>
    <div>
        Notification is <br>
        <ul>
            <li v-for="notification in notifications" :key="notification.id">{{notification}}</li>
        </ul> 
        <br />
        <button class="btn btn-primary">Click</button>
    </div>
</template>

<script>
    export default {
        name:"UserComponent",
        props:{
            user:{
                type:Number,
                default:null
            }
        },
        mounted(){
           this.getNotifications();
        },
        data(){
            return {
                notifications:[]
            }
        },
         methods:{
            getNotifications(){
               window.Echo.channel('notificationChannel')
                .listen('SendNotification',(e) =>{
                    this.notifications.push(e.notification)
                    console.log('test');
            }),

            window.Echo.private('notificationChannel2.1')
            .listen('notification-event',(e)=>{
                console.log('notification event fired');
            })
            }
        }
    }
</script>