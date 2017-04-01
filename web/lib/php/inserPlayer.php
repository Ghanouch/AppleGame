<?php
	require 'Dbconnection.php';
	extract($_GET);
	$stmt = $db->query("select count(IdAcheteur) as count from acheteur")->fetch();
	$buyer = $stmt["count"];
	$stmt = $db->query("select count(IdVendeur) as count from vendeur")->fetch();
	$sellers = $stmt["count"];
	if($buyer <= $sellers) {
		$stmt = $db->query("SELECT IdAcheteur from acheteur where Surnom = '".$nom."'");
		$query = "INSERT INTO acheteur(Surnom) values('".$nom."')";
	}
	else {
		$stmt = $db->query("select IdVendeur from vendeur where Surnom = '".$nom."'");
		$query = "INSERT INTO vendeur(Surnom) values('".$nom."')";
	}
	if($stmt->rowCount()  == 0){
		if($stm = $db->query($query)){
			session_start();
			if($buyer <= $sellers){
				echo "buyer";
				$_SESSION["player"] = $db->lastInsertId("IdAcheteur");
			}
			else {
				echo "seller";
				$_SESSION["player"] = $db->lastInsertId("IdVendeur");
			}
		}else{
			echo "ERROR";
		}
	}else{
		echo "Please choose another name";
	}
?>
