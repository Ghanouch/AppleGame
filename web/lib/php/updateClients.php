<?php
	require 'Dbconnection.php';
	session_start();
	extract($_POST);
	$stmt = $db->exec("update ".$type." set clients = ".$count." where id".$type."=".$_SESSION["player"]);
?>
