<!DOCTYPE html>
<head>
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher(MY_KEY, {
            cluster: 'us2',
            forceTLS: false,

            channelAuthorization: {
                endpoint: "http://127.0.0.1:8000/authenticate",
                //transport: "jsonp",
                params: {
                    param1: 'value1',
                    param2: 'value2'
                }
            },
            activityTimeout: 1
        });


        /*
         var channel = pusher.subscribe('my-channel');
         channel.bind('my-event', function(data) {
         alert(JSON.stringify(data));
         }); */

        var presenceChannel = pusher.subscribe('presence-lab-45');

        presenceChannel.bind("pusher:subscription_succeeded", function () {
            console.log(presenceChannel.members.count);
            var me = presenceChannel.members.me;
            alert(me.id)

            presenceChannel.members.each(function (member) {
                var userId = member.id;
                var userInfo = member.info;
            });

        });

    </script>
</head>
<body>
    <h1>Pusher Test</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
    </p>
</body>