<!DOCTYPE html>
<?php
	session_start();
	//if(isset($_SESSION["player"])) header('Location: wait.html');
	require 'lib/php/Dbconnection.php';
	$stmt = $db->query("select value from PARAMETERS where PARAMETER = 'gameState'")->fetch();
	$value = $stmt['value'];
?>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Jeu de pomme</title>
        <link rel="stylesheet" href="css/fonts.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/win.css">
  </head>
  <script src="lib/js/jquery.js"></script>
	<script src="lib/js/socket.io.js"></script>
	<script src="lib/js/chat.js"></script>
  <script src="lib/js/script.js"></script>

  <body>
  <div class="logo"><img src="pictures/logo.png"></div>
  	<div class="s">
  		<div class="ss">
  		</div>
  		<div class="windows8">
			<div class="wBall" id="wBall_1">)
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
    <div class="wrapper">
	<div class="container">
	<?php if($value == "0"){?>
		<form method="POST"  class="form">
			<input required type="text" placeholder="Enter your name" name="nom">
			<button type="submit" id="login-button-Player">Play</button>
		</form>
	<?php }else echo "<div class='started'>the game has already started !</div> ";?>
	</div>
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
  </body>
</html>
