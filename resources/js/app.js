/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('user-component', require('./components/UserComponent.vue').default);
Vue.component('notification-component', require('./components/NotificationComponent.vue').default);
Vue.component('message-component', require('./components/MessageComponent.vue').default);
Vue.component('post-component', require('./components/PostsComponent.vue').default);
Vue.component('private-component', require('./components/privateComponent.vue').default);

import axios from 'axios'
import VueAxios from 'vue-axios'


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

Vue.use(VueAxios, axios)

function getCookie(name){
    const value = `;${document.cookie}`;
    const parts = value.split(`;${name}=`);
    if(parts.length === 2){
        return parts.pop().split(';').shift();
    }
}

function request(url , options){
    const csrfToken = getCookie('XSRF-TOKEN');
    return fetch(url , {
        headers:{
            'content-type':'application/json',
            'accept' : 'application/json',
            'XSRF-TOKEN' : decodeURIComponent(csrfToken)
        },
        credentials:"include",
        ...options
    });
}
function logout()
{
    return request('/logout',{
        method:"POST"
    });
}

function login(){
    return request('/login',{
        method:"POST",
        body:JSON.stringify({
            email:"zaki@websocket.com",
            password:"12345678"
        })   
    });
}

// fetch('sanctum/csrf-cookie/',{
//     headers:{
//         'content-type':'application-json',
//         'accept':'application/josn'
//     },
//     credentials:"include",

// }).then(()=>logout())
// .then(()=>{
//     return login();
// }).then(()=>{
// // code here 
// });