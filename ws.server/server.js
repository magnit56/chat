var io = require('socket.io')(6001, {
    cors: {
      origin: "http://localhost:3000",
      credentials: true
    }
}),
    Redis = require('ioredis'),
    redis = new Redis();

redis.psubscribe('*', function(error, count) {
    console.log(count);
});

redis.on('pmessage', function(pattern, channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data.message);
    console.log(channel);
    console.log(message);
});
