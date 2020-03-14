import Echo from 'laravel-echo'

let wscToken = gGetWscToken();
if (gIsEmpty(wscToken)) {
    wscToken = '';
}
window.io = require('socket.io-client');
window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    auth: {
        headers:
            {
                'authorization': wscToken
            }
    }
});
