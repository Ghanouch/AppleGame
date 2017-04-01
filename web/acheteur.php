	<!DOCTYPE html>
	<html>
	<head>
		<title>Jeu de pomme</title>
		<link rel="stylesheet" href="css/fonts.css">
	    <link rel="stylesheet" href="css/player.css">
			<link rel="stylesheet" href="css/Popup.css">
	    <link rel="stylesheet" href="css/win.css">
	</head>
	<body>
		<a class="rapport" href=<?php session_start(); echo "lib/php/Jasper.php?page_name=acheteur&id_player=".$_SESSION["player"]; ?> target="_blank"></a>
		<div id="sessionID" style="display:none"><?php echo $_SESSION["player"]; ?></div>
		<div id="sessionPlayer" style="display:none">acheteur</div>
		<div id="finTranche"style="display:none">
				<div class="messageFin" >
					Please wait for the next phase to start
					if you want to check your results<br>
				</div>
				
						<a class="report" href=<?php echo "lib/php/Jasper.php?page_name=acheteur&id_player=".$_SESSION["player"]; ?> target="_blank"></a>

						<div class="windows8">
						<div class="wBall" id="wBall_1">
							<div class="wInnerBall"></div>
						</div>
						<div class="wBall" id="wBall_2">
							<div class="wInnerBall"></div>
						</div>
						<div class="wBall" id="wBall_3">
							<div class="wInnerBall"></div>
						</div>
						<div class="wBall" id="wBall_4">
							<div class="wInnerBall"></div>
						</div>
						<div class="wBall" id="wBall_5">
							<div class="wInnerBall"></div>
						</div>
					</div>
				</div>
</div>
	<div id="body">
		<div class="slog">
		</div>
		<div class="header noselect">
			<div class="id idd">
				<div class="IDimage idd"></div>
				<div class="IDname idd"></div>
			</div>
			<div class="rightHeader idd">
				<div class="parties idd">
					<div id="heart1" class="heart"></div>
					<div id="heart2" class="heart"></div>
					<div id="heart3" class="heart"></div>
				</div>
				<div class="timer idd">10:00</div>
				<div class="close idd"></div>
			</div>
		</div>
		<div class="wrapper noselect">
			<a class="rapport" href=<?php echo "lib/php/Jasper.php?page_name=acheteur&id_player=".$_SESSION["player"]; ?> target="_blank"></a>

			<div class="card">
						<div class="cardVl">

						</div>
					</div>			<div class="game">
				<div class="playersList idd"></div>
				<div class="chatHeads idd">
					<div class="chat">
						<div class="Chatheader">
							<div class="Chatname">Walid Hammioui</div>
							<div class="Chatclose"></div>
							<div class="Chatmin"></div>
						</div>
						<div class="chatBody">
						</div>
						<div class="negociate">
							<input id="messageText" class=" idd"type="text" name="message" placeholder="write a message...">
							<div class="negociateOptions idd">
								<div class="send idd"></div>
								<div class="price idd">
									<div class="minus idd">-</div>
									<div class="pricing idd">70</div>
									<div class="plus idd">+</div>
								</div>
								<div class="suggest idd"></div>
								<div class="validateParice idd "></div>
							</div>
						</div>
					</div>
			</div>
			<div class="us">Made With <img src="pictures/partyAlive.png" width=15 height=15> by Med Reda Benchraa & Issam Ghanouch</div>
		</div>
	</div>
	<div id = "notification">
		<span id = "line1" class = "menuText">Gongratuation</span>
		<span class = "menuText">Keep up the hard work</span>
		<div id = "close"><span class = "text">Close</span></div>
	</div>
	<div id="rapport_id"></div>
	</body>
			<script src="lib/js/jquery.js"></script>
			<script src="lib/js/jquery-ui.js"></script>
			<script src="lib/js/popup.js"></script>
			<script src="lib/js/socket.io.js"></script>
	  	<script src="lib/js/script.js"></script>
			<script src="lib/js/chat.js"></script>
			<script src="lib/js/acheteur.js"></script>
	</html>
