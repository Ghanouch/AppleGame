<?php
	require 'Dbconnection.php';
	$stmt = $db->query("select count(idVendeur) as cV from vendeur")->fetch();
	$buyers = $stmt["cV"];
	$stmt = $db->query("select count(idAcheteur) as cV from acheteur")->fetch();
	$sellers = $stmt["cV"];
	$buyers += $sellers;
	echo $buyers;
?>