<?php
	require 'Dbconnection.php';
	$time = $_POST["time"];
	$bcards = array(
			"75" => "2",
			"65" => "4",
			"60" => "12",
			"50" => "11",
			"40" => "7");
	$scards = array(
			"80" => "2",
			"75" => "4",
			"70" => "8",
			"60" => "6",
			"50" => "5",
			"45" => "7",
			"35" => "4");
	$stmt = $db->query("select IdAcheteur from acheteur")->fetchAll();
	foreach ($stmt as $key) {
		$picked = False;
		while($picked == False){
			switch (rand(0,4)) {
			    case 0:
			        $var="75";
			        break;
			    case 1:
			        $var="65";
			        break;
			    case 2:
			        $var="60";
			        break;
			    case 3:
			        $var="50";
			        break;    
			    case 4:
			        $var="40";
			        break;
			}
			if($bcards[$var] == "0") $picked = False;
			else{
				$picked = True;
				$bcards[$var] = (((int)$bcards[$var])-1)+"";
				$db->exec("UPDATE  acheteur SET  CarteValeur =  ".(int)$var." WHERE  IdAcheteur = ".$key["IdAcheteur"]);
				$db->exec("UPDATE  parameters SET  VALUE =  '".$bcards[$var]."' WHERE PARAMETER = 'B".$var."'");
			}
		}
	}
	$stmt = $db->query("select IdVendeur from vendeur")->fetchAll();
	foreach ($stmt as $key) {
		$picked = 0;
		while($picked == 0){
			switch (rand(0,6)) {
			    case 0:
			        $var="80";
			        break;
			    case 1:
			        $var="75";
			        break;
			    case 2:
			        $var="70";
			        break;
			    case 3:
			        $var="60";
			        break;    
			    case 4:
			        $var="50";
			        break;
				case 5:
			        $var="45";
			        break;    
			    case 6:
			        $var="35";
			        break;
			}
			if($scards[$var] == "0") $picked = 0;
			else{
				$picked = 1;
				$scards[$var] = (((int)$scards[$var])-1)+"";
				$db->exec("UPDATE  vendeur SET  CarteValeur =  ".(int)$var." WHERE  IdVendeur = ".$key["IdVendeur"]);
				$db->exec("UPDATE  parameters SET  VALUE =  '".$scards[$var]."' WHERE PARAMETER = 'S".$var."'");
			}
		}
	}
	$db->exec("UPDATE  parameters SET  VALUE = '1' WHERE  PARAMETER =  'gameState'");
	$db->exec("UPDATE  parameters SET  VALUE = now() WHERE  PARAMETER =  'startTime'");
	$db->exec("UPDATE  parameters SET  VALUE =  '".$time."' WHERE  PARAMETER =  'partyTime' ");
?>