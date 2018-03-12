var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(8890, function(){
    console.log('Listening on Port 8890');
});
var clients = [];

io.on('connection', function (socket) {
    var redisClient = redis.createClient();
    redisClient.subscribe('message');

    //guarda los  sockets que se van conectando identificados por su token de usuario.
    clients.push({ socket:socket.id, token:socket.handshake.query.token });

    io.sockets.emit('onlineUsers',clients);
    console.log("onlineUsers :: ",clients.length);


    redisClient.on("message", function(channel, message) {
        var obj = JSON.parse(message);
        socket.emit(obj.channel, message);
    });


    socket.on('disconnect', function() {
        io.sockets.emit('disconnectedUser',socket.id);
        
        redisClient.quit();
        clients.splice(clients.indexOf(socket), 1);

        io.sockets.emit('onlineUsers',clients);
        console.log("onlineUsers :: ",clients.length);
    });

});