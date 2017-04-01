<?php
	require 'Dbconnection.php';
  extract($_GET);
  if($type == "vendeur"){
    $IdVendeur = $myid;
    $idAcheteur = $otherid;
  }else{
    $idAcheteur = $myid;
    $IdVendeur = $otherid;
  }
	$stmt = $db->query("select * from chat where IdVendeur =".$IdVendeur." && idAcheteur=".$idAcheteur)->fetchAll();
	foreach ($stmt as $key) {
    if($type == "vendeur") {
      if($key["sender"] == 0) echo "you@".$key["message"]."|";
      else echo "him@".$key["message"]."|";
    }
    else {
      if($key["sender"] == 1) echo "you@".$key["message"]."|";
      else echo "him@".$key["message"]."|";
    }
  }
?>
