window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');


window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'WebSocketAppKey',
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
    // auth: {
    //     headers: {
    //         Authorization: 'Bearer ' + '972d5122462716e0293266c82d99f9c3b1d062b3ed6ac1f124bafbac355d368b'
    //     },
    // },
    auth: {headers: {
        'X-CSRF-TOKEN': 'eyJpdiI6InNqQTlQYnVvck5ja01HSVdzc1JiUGc9PSIsInZhbHVlIjoiUDF2MEtOYnBXTTR6Vm5aVE5MS29pdVl1S3FSVTlDdExwS1lOYUpJeFFCeTRldzVCTUg1NkZ6YmZiLyt3a1k1VzJtM2pwa0VWRFREalpzeW5yM0podE1pcERNdFRGN016ZUlxbi9lbnhHVFYyNllCcFJXWG93NUM1U2VvV3BlTXYiLCJtYWMiOiI3MmY2NzJjYjE2ZGEyYTRhM2NlZGJmMjMyMWY5ODE4NWFlZmZlMmJmZDM3NjE3OTZjNmU4MDJiYzQxYzJkZTJmIiwidGFnIjoiIn0%3D'
    }},
    // authEndpoint : 'http://127.0.0.1/api/broadcasting/auth',
    // authorizer: (channel) => {
    //     return {
    //         authorize: (socketId, callback) => {
    //             axios.post('/api/broadcasting/auth', {
    //                 socket_id: socketId,
    //                 channel_name: channel.name
    //             })
    //             .then(response => {
    //                 callback(false, response.data);
    //             })
    //             .catch(error => {
    //                 callback(true, error);
    //             });
    //         }
    //     };
    // },
});
