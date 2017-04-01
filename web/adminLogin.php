<!DOCTYPE html>
<?php
session_start();
	if(isset($_SESSION['admin'])) {
		header('Location: adminStart.php');
		die();
	}
?>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Jeu de pomme</title>
        <link rel="stylesheet" href="css/fonts.css">
        <link rel="stylesheet" href="css/style.css">
  </head>
  <script src="lib/js/jquery.js"></script>
	<script src="lib/js/socket.io.js"></script>
  <script src="lib/js/script.js"></script>

  <body>
  <div class="logo"><img src="pictures/logo.png"></div>
  	<div class="s">
  		<div class="ss">
  		</div>
  	</div>
    <div class="wrapper">
	<div class="container">
	<div class="admin"><img src="pictures/admin.png"></div>
		<form method="POST" class="form">
			<input required type="password" placeholder="Enter you password" name="password">
			<button type="submit" id="login-button-Admin">Login</button>
		</form>
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
	<script src="lib/js/index.js"></script>r
  </body>
</html>
