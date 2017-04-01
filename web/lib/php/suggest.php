<?php
  require 'Dbconnection.php';
  extract($_POST);
  if($Validate_Vendeur == '1') {
    $a=1;
    $b=0;
  }else{
      $a = 0;
      $b = 1;
  }
  $db->exec("delete from suggestion where id_vendeur=".$id_vendeur." AND id_acheteur=".$id_acheteur."");
  $db->exec(" INSERT INTO `suggestion`(`Id_vendeur`, `Id_acheteur`, `Montant`, `Validate_Vendeur`, `Validate_Acheteur`)  VALUES(".$id_vendeur.",".$id_acheteur.",".$Montant_Sugg.",".$a.",".$b.") " );
?>
