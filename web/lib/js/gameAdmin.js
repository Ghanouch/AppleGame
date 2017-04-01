var socket = io.connect('127.0.0.1:1337');
var parties = 3;
var duration =  parseInt(getCookie('duration')) * 60000;
var time = new Date(duration);
var interv;
var clicked = 0;
$(function () {
      socket.on('disconnected', function() {
          socket.emit('disconnect', username);
      });
      socket.emit('join', {username: "admin"});
      socket.on('connect', function () {
        console.log(this);
      });
      socket.on('init', function () {
        $.get("lib/php/init.php",{type:"acheteur"},function(data){
          $.get("lib/php/startTheGame.php",{type:"acheteur"},function(data){
            console.log(1);
            socket.emit('updateCard', {username: "admin"});
          });
        });
      });
      socket.on('endParty', function (data) {
        console.log( data.parties + " " +  data.time + " " + data.duration + " " + data.gameState);
        parties = data.parties;
        gameState = data.gameState;
        console.log("end party");
        if(parties > 1){
          $('.startgame').fadeIn();
        }
        done();
        stopTimer();
      });
      socket.on('startParty', function (data) {
        console.log("start party socket");
        parties = data.parties;
        time = new Date(data.time);
        duration = data.duration;
        gameState = data.gameState;
        timerStart();
      });
      socket.on('setParam', function (data) {
        console.log( data.parties + " " +  data.time + " " + data.duration + " " + data.gameState);
        parties = data.parties;
        time = new Date(data.time);
        duration = data.duration;
        gameState = data.gameState;
        switch(parties) {
            case 2:
                $('#heart1').addClass('dead');
                break;
            case 1:
                    $('#heart1').addClass('dead');
                    $('#heart2').addClass('dead');
            break;
            case 0:
                    $('#heart1').addClass('dead');
                    $('#heart2').addClass('dead');
                    $('#heart3').addClass('dead');
                    $(".timer").text("00:00" );
                    $('.startgame').fadeOut();
            break;
        }
        if(gameState == 0){
            $(".timer").text("00:00" );
            if(parties > 1) $('.startgame').fadeIn();
        }else{
            timerStart();
        }
      });
        socket.emit('getParam', {username: "admin"});
        $('.startgame').bind('click', function (event) {
                console.log("start game click");
                socket.emit('startParty', {username: "admin"});
                $('.startgame').fadeOut();
                $.post("lib/php/updateParties.php",{update:parties},function(data){});
        });
});
function stopTimer(){
    clearInterval(interv);
}
function timerStart(){
    interv = setInterval(function(){
        time = new Date(time - 1000);
        if(time == new Date("01","01","1970","00","00","00") || time <= 0){
            time = 0;
            done();
            $(".timerWatch").text("00:00" );
            clearInterval(interv);
        }
        else{
        displayTime();
        }
    }, 1000);
};
function displayTime(){
    $(".timerWatch").text(pad_with_zeroes(time.getMinutes(),2) + ":" + pad_with_zeroes(time.getSeconds(),2) );
}
function done(){
    if(parties == 2 ) $('#heart1').addClass('dead');
    if(parties == 1 ) $('#heart2').addClass('dead');
    if(parties == 0 ) $('#heart3').addClass('dead');
    if(parties > 1) {
        $('.startgame').fadeIn();
        time = new Date(duration);
    }else{
        $(".timerWatch").text("00:00" );
    }
    parties--;
}
function pad_with_zeroes(number, length) {
    var my_string = '' + number;
    while (my_string.length < length) my_string = '0' + my_string;
    return my_string;
}
