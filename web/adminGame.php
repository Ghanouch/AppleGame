<!DOCTYPE html>
<html>
<head>
	<title>Jeu de pomme</title>
	<link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/styleAdminStyle.css">
  	<script src="lib/js/jquery.js"></script>
		<script src="lib/js/socket.io.js"></script>
		<script src="lib/js/script.js"></script>
  	<script src="lib/js/players.js"></script>
</head>
<body>
<div id="body">
<div class="admin">Administrator</div>
	<div class="wrapper">
		<div class="game">
			<div class="watch gameF">
				<div class="timerWatch gameTimerF">00:00</div>
				<div class="iconWatch gameTimerF">O</div>
			</div>
			<div class="parties gameF">
				<div id="heart1" class="heart"></div>
				<div id="heart2" class="heart"></div>
				<div id="heart3" class="heart"></div>
			</div>
			<div class="startgame gameF" style="display :none">Start</div>
			<a class="rep gameF" href="lib/php/Jasper.php?page_name=Transaction" target="_blank" ><img width=30 height=30 src="pictures/ic_local_print_shop_white_18dp.png"></a>
		</div>


			<div class="player">
				<div id ="buyerheader" class="tableHeader">Buyers</div>
				<div id= "buyer" class="tableRows">
				</div>
			</div>
			<div class="player">
				<div id ="sellerheader" class="tableHeader">Sellers</div>
				<div id ="seller" class="tableRows">
				</div>
			</div>

	</div>

</div>

</body>
<script src="lib/js/gameAdmin.js"></script>
</html>
