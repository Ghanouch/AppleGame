<?php
	require 'Dbconnection.php';
	if($_GET["type"]=="Acheteur") {
		$table = "acheteur";
		$id = "idAcheteur";
	}
	else {
		$table = "vendeur";
		$id = "idVendeur";
	}
	session_start();
	$stmt = $db->query("select * from ".$table." where ".$id." = ".$_SESSION["player"])->fetch();
	echo $stmt["CarteValeur"]."|".$stmt["Surnom"];
	if($_GET["type"]=="vendeur") {
		echo "|".$stmt["Slogon"];
	}
?>
