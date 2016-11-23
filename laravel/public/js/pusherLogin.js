/**
 * Created by Edward on 23/11/2016.
 */


// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher(pusher_key, {
    cluster: 'eu',
    encrypted: true
});

var channel = pusher.subscribe('test_channel');
channel.bind('my_event', function(data) {
    alert(data.message);
});
