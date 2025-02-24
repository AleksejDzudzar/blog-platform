import axios from 'axios';
window.axios = axios;
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Echo.private('chat-' + userId)
    .listen('NewMessage', (event) => {
        console.log('Message received:', event.message);
        // You can now display the message, for example, in a chat window.
    });
