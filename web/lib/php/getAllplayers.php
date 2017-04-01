<?php
	require 'Dbconnection.php';
	$stmt = $db->query("select IdVendeur , Surnom from vendeur")->fetchAll();
	foreach ($stmt as $key) {
		echo $key["IdVendeur"]."_".$key["Surnom"]."-";
	}
	echo "|";
	$stmt = $db->query("select IdAcheteur, Surnom from acheteur")->fetchAll();
	foreach ($stmt as $key) {
		echo  $key["IdAcheteur"]."_".$key["Surnom"]."-";
	}
?>
