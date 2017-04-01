<?php
	require 'Dbconnection.php';
	session_start();
	extract($_POST);
	$stmt = $db->exec("update vendeur set slogon = '".$slogon."' where idVendeur=".$_SESSION["player"]);
?>