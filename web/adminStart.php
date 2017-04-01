<!DOCTYPE html>
<?php
	require 'lib/php/Dbconnection.php';
	session_start();
	if(!isset($_SESSION['admin'])) {
		header('Location: adminLogin.php');
		die();
	}
	$stmt = $db->query("select value from PARAMETERS where PARAMETER = 'gameState'")->fetch();
	$value = $stmt['value'];
	if($value == "1") header('Location: adminGame.php');
?>
<html>
<head>
	<title>Jeu de pomme</title>
	<link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/styleAdminStyle.css">
    <link rel="stylesheet" href="css/win2.css">
		<script src="lib/js/jquery.js"></script>
    <script src="lib/js/socket.io.js"></script>
  	<script src="lib/js/script.js"></script>
  	<script src="lib/js/players.js"></script>
	</head>
<body>
<div id="body">
<div class="admin">Administrator</div>
	<div class="waiting">
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
	<div class="wrapper">
		<div class="timer">
			<input type="text"  name="time" class ="timerInput time" value="10" />
			<div class="mostatile time"> Minutes per party</div>
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
		<div class="start">Start</div>
	</div>
</div>
</body>
</html>
