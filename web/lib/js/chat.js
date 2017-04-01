var socket = io.connect('127.0.0.1:1337');
var parties = 3;
var duration
var time;
var interval;
  window.onload = function() {
      var username = $('#sessionID').html();
      socket.emit('join', {username: username});
      socket.on('connect', function () {
        console.log(this);
      });
      socket.on('startGame', function (data) {
        if(you == "buyer") window.location.replace ("acheteur.php");
        else window.location.replace ("vendeur.php");
      });
      socket.on('endParty', function (data) {
        console.log("endParty");
        console.log( data.parties + " " +  data.time + " " + data.duration + " " + data.gameState);
        parties = data.parties;
        gameState = data.gameState;
        console.log("end party");
        if(parties > 0){
          $("#finTranche").fadeIn();
        }else{
          $("#finTranche").fadeIn();
          $(".messageFin").html("The game has ended if you want to check your final results<br>");
        }
        done();
        stopTimer();
      });
      socket.on('startParty', function (data) {
        $("#finTranche").fadeOut();
        console.log("startParty");
        console.log("start party socket");
        parties = data.parties;
        time = new Date(data.time);
        duration = data.duration;
        gameState = data.gameState;
        timerStart();
      });
      socket.on('updateCard', function (data) {
        console.log(1);
        getCardValue($('#sessionPlayer').html());
      });
      socket.on('brah', function (data) {
        if($('#sessionPlayer').html() == "acheteur"){
          console.log(data.sender + ':'+ data.message);
          $(".slog").text(data.sender + ':'+ data.message);
          $(".slog").fadeIn();
          $(".slog").effect("bounce");
        }
      });

      socket.on('setParam', function (data) {
        console.log("setParam");
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
            $("#finTranche").fadeIn();
            if(parties > 0){
              $("#finTranche").fadeIn();
            }else{
              $("#finTranche").fadeIn();
              $('.windows8').fadeOut();
              $(".messageFin").html("The game has ended if you want to check your final results<br>");
            }
        }else{
            timerStart();
        }
      });
        socket.emit('getParam', {username: username});
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
    $(".timer").text(pad_with_zeroes(time.getMinutes(),2) + ":" + pad_with_zeroes(time.getSeconds(),2) );
}
function done(){
    if(parties == 2 ) $('#heart1').addClass('dead');
    if(parties == 1 ) $('#heart2').addClass('dead');
    if(parties == 0 ) $('#heart3').addClass('dead');
    if(parties > 0) {
        $(".timer").text("00:00");
    }
    if(parties !=0) parties--;
}
function pad_with_zeroes(number, length) {
    var my_string = '' + number;
    while (my_string.length < length) my_string = '0' + my_string;
    return my_string;
}
      socket.on('update', function (data) {
            if(v_vendeur != 0) if(data.sender == "Vendeur")  {
              $("#P"+data.username + " .clients").html(data.count);
            }
            if(v_acheteur != 0) if(data.sender == "Acheteur")  {
              $("#P"+data.username + " .clients").html(data.count);
            }
      });
      socket.on('message', function (data) {
        if(data.message == "refresh page please"){
          var i=0;
          while(i<headList.length && headList[i] != data.sender) i++;
          headList.splice(i,1);
          if(v_vendeur != 0) {
            socket.emit('updateClient', { sender: "Acheteur", username: v_vendeur,count:headList.length });
          }
          if(v_acheteur != 0){
            socket.emit('updateClient', { sender: "Vendeur", username: v_acheteur,count:headList.length });
          }
          $(".playersList #P"+data.sender).fadeIn();
          $(".chatHeads #CP"+data.sender).fadeOut();
          $(".chatHeads #CP"+data.sender).remove();
          getCardValue();
          $(".chat").hide();
          $("#screen").css({"visibility":"visible","opacity":".7"});
          $("#notification").css({"visibility":"visible","opacity":"1","width":"300px", "height":"150px"});
          $("#content").css({"height":"90%", "width":"90%","border-radius":"10px"});
        }
        else {
          if(data.sender != user && headList.length !=1&& headList.length !=0) {
          $('#CP'+data.sender).animate({
            backgroundColor : "rgb(243, 33, 82)",color : "white"
          });
        }
          var i=0;
          while(i<headList.length && headList[i] != data.sender) i++;
          if(i == headList.length){
              $("#P"+data.sender).fadeOut();
              headList.push(data.sender);
              $('.chatHeads').append("<div style='display:none' id='CP"+data.sender+"' class='head idd' onclick='showChat(this)'>"+$("#P"+data.sender).text().charAt(0)+"</div>");
              $('#CP'+data.sender).fadeIn();
              if(headList.length == 1){
                  $('.chat').attr('id', 'CCP'+data.sender);
                  $('.chat .Chatname').html($('#P'+data.sender+" .name").text().substring(0,$('#P'+data.sender+" .name").text().length-1));
                  getConvo(data.sender,$('#sessionPlayer').html());
                  $('.chat').fadeIn();
                  user = data.sender;
              }
          }else{
            if($('.chat').css('display') == "none"){
              $('.chat').attr('id', 'CCP'+data.sender);
              getConvo(data.sender,$('#sessionPlayer').html());
              $('.chat .Chatname').html($('#P'+data.sender+" .name").text().substring(0,$('#P'+data.sender+" .name").text().length-1));
              $('.chat').fadeIn();
            }
          }
          if(data.sender == user)
          if(data.message) {
              $('.chatBody').append("<div class='msgRight'><div class='headChatMessage idd'>"+$('#P'+user+" .img").text()+"</div><div class='message idd'>"+data.message+"</div></div>");
              height += parseInt($(".msgRight").height());
              $('.chatBody').animate({scrollTop: height});
          } else {
              console.log("There is a problem:", data);
          }
          user = data.sender;
          }
      });
      socket.on('disconnected', function() {
          socket.emit('disconnect', username);
          if(v_vendeur != 0) {
            socket.emit('updateClient', { sender: "Acheteur", username: v_vendeur,count:0 });
          }
          if(v_acheteur != 0){
            socket.emit('updateClient', { sender: "Vendeur", username: v_acheteur,count:0 });
          }
      });
      $('.send').bind('click',function (event){
          sendMessage();
      });
      $('input').bind('keypress', function(event) {
        if(event.keyCode==13){
          sendMessage();
      	}
      });
      function sendMessage(){
        var text = $('#messageText').val();
        if(text.length>0){
          var user = $('.chat').attr("id");
          user = " " + user + "";
          user = user.substring(4);
          socket.emit('send', { message: text, username: user,sender: username,type :$('#sessionPlayer').html()});
          $('.chatBody').append("<div class='msgLeft'><div class='headChatMessage idd'>"+$(".IDimage").text()+"</div><div class='message idd'>"+$('#messageText').val()+"</div></div>")
          $('#messageText').val('');
          height += parseInt($(".msgLeft").height());
          $('.chatBody').animate({scrollTop: height});
        }
      }

  }
