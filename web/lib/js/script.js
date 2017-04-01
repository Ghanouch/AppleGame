	var check = 0;
	var you;
	var socket = io.connect('127.0.0.1:1337');
	 $(function () {
	 	$('input[name="time"]').keypress(function() {
			    if (this.value.length > 1) {
			        return false;
			    }
			});
	 	});
      $(function () {
        $('button[id="login-button-Player"]').bind('click', function (event) {
			if($('input[name="nom"]').val().length  > 0){
				event.preventDefault();
							setCookie("username", $('input[name="nom"]').val());
		          $.ajax({
		            type: 'GET',
		            url: 'lib/php/inserPlayer.php',
		            data: $('form').serialize(),
		            success: function (data) {
		            	you = data;
		            	console.log(data);
		            	var res = $('form').serialize().split('&');
		   				$(".ss").append("Hello "+res[0].split('=')[1]+" ,please Wait for the admin <br>to start the game, you will be a "+data+" during the game");
		   				if(data != "seller" && data!= "buyer"){
		   					//console.log("Something went wrong, please refill the form");
		   					//window.location.replace ("PlayerLogin.php");
		   				}
		            }
		          });
		        $("form").css('display','none');
        		$(".s").css('display', 'block');

		}
        });
      });
     $(function () {
        $('button[id="login-button-Admin"]').bind('click', function (event) {
        	 event.preventDefault();
		         $.ajax({
		            type: 'POST',
		            url: 'lib/php/checkPassword.php',
		            data: $('form').serialize(),
		            success: function (data) {
		   				if(data == "0") console.log("Wrong Password");
		   				else if(data == "1") window.location.replace ("adminStart.php");
		   				else console.log(data+"--");
		            }
		        });
        });
      });

      $(function () {
        $('.start').bind('click', function (event) {
        	event.preventDefault();
					socket.emit('setDuration', {duration: $('input').val()});
					socket.emit('startGame', {duration: $('input').val()});
        	setCookie('duration',$('input').val());
        	$(".waiting").fadeIn();
        	$('.player').fadeOut();
        	$('.start').fadeOut();
					$.post("lib/php/startTheGame.php",{time:$('input').val()},function(data){
					window.location.replace ("adminGame.php");
			});
        });
      	});
       function setCookie(key, value) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
        }
        function getCookie(key) {
            var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
            return keyValue ? keyValue[2] : null;
        }
