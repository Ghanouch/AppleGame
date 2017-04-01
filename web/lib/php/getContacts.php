<?php
	require 'Dbconnection.php';
	$stmt = $db->query("select * from ".$_GET["type"])->fetchAll();
	if($_GET["type"] == "vendeur") $n = "IdVendeur"; else $n = "IdAcheteur";
	foreach ($stmt as $key) {
		echo $key["Surnom"]."/".$key[$n]."/".$key["clients"]."|";
	}
?>
