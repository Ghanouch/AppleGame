<?php
	require 'Dbconnection.php';
  session_start();
  extract($_POST);
	$stmt = $db->query("select clients from ".$type." where id".$type." = ".$_SESSION["player"])->fetch();
 	echo $stmt['value'];
?>
