var express = require("express");
var app = express();
var port = 1337;
var users = [];
app.set('views', __dirname + '/');
app.set('view engine', "jade");
app.engine('jade', require('jade').__express);
app.get("/", function(req, res){
    res.render("page");
});
app.use(express.static(__dirname + '/public'));
var mysql = require('mysql');
var io = require('socket.io').listen(app.listen(port));
console.log("Listening on port " + port);
io.sockets.on('connection', function (socket) {
      console.log(users);
      socket.on('join', function (data) {
      var clientInfo = new Object();
      clientInfo.username = data.username;
      clientInfo.clientId = socket.id;
      users.push(clientInfo);
      console.log(users);
      console.log(data.username+" Logged !");
      socket.join(data.username);
    });
    socket.on('disconnect', function(data) {
         for( var i=0, len=users.length; i<len; ++i ){
                var c = users[i];
                if(c.clientId == socket.id){
                    console.log(c.username+' Got disconnect!');
                    users.splice(i,1);
                    break;
                }
          }
          console.log(users);
    });
    //socket.emit('message', { message: 'welcome to the chat' });
    socket.on('send', function (data) {
      var connection = mysql.createConnection({
       host     : '127.0.0.1',
       user     : 'root',
       password : '',
       database : 'apple_game'
      });
        connection.connect();
        var sender;
        for( var i=0, len=users.length; i<len; ++i ){
               var c = users[i];
               if(c.clientId == socket.id){
                   sender = c.username;
                   break;
               }
         }
         if(data.type == "vendeur") {
           var idvendeur = sender;
           var idacheteur = data.username;
           var i = 0;
         }else{
           var idacheteur = sender;
           var idvendeur = data.username;
           var i = 1;
         }
         console.log(sender + " " + data.username);
         io.sockets.in(data.username).emit('message', data);
         var query = connection.query('INSERT into chat(idvendeur,idacheteur,date,message,typemessage,sender) values('+idvendeur+','+idacheteur+',now(),"'+data.message+'",1,'+i+')', function(err, result) {
          if (!err) console.log('The solution is: ', result);
          else console.log(err);
        });
        console.log(query.sql);
        connection.end();
    });

});
