<?php
require 'Dbconnection.php';
extract($_POST);
 $ETAT =  ETAT_VALIDATE();

 if($Type_Joueur == "Vendeur")
 {
  switch($ETAT)
  {
   case 0:   echo "0|AUCUNE PROPOSITION N EST ENRIGISTRE ";  ;break;
   case 1:   echo "1|".MONTATNT_VALIDATE() ;
             Add_In_Transaction();

             // njbad mn base de donnée sa nouvelle valeur sur sa varte
             break ;
   case 2:   echo "2|L acheteur n as pa encore confirmé ou suggerer un autre prix";
  }
 }
  else
  {
     switch($ETAT){
  	case 0:   echo "0|AUCUNE PROPOSITION N EST ENRIGISTRE ";  ;break;
    case 1:   echo "1|Le vendeur n as pa encore confirmé ou suggerer un autre prix";break;

    case 2:   echo "2|".MONTATNT_VALIDATE() ;
     Add_In_Transaction();


     }


  }



// Cette fonction Return  0- Si aucune negociation se faisait
//                        1- Si l acheteur suggeste un prix mais le vendeur pas encore
//                        2- Si l vendeur suggeste un prix mais l acheteur pas encore
//

function ETAT_VALIDATE()
{
  require 'Dbconnection.php';
extract($_POST);

 $Res = $db->query("select Validate_Vendeur as V_V , Validate_Acheteur as V_A from suggestion where Id_vendeur=".$id_vendeur." AND id_acheteur=".$id_acheteur."  ");

 if($Res->rowCount()  == 0) return 0 ;
 else
 {
 $Res = $db->query("select Validate_Vendeur as V_V , Validate_Acheteur as V_A from suggestion where Id_vendeur=".$id_vendeur." AND id_acheteur=".$id_acheteur."  ")->fetch();
 if($Res["V_A"] == 1 && $Res["V_V"] == 0) return 1 ;
 else
 {
  if($Res["V_A"] == 0 && $Res["V_V"] == 1) return 2;
 }

 }
}

function MONTATNT_VALIDATE()
{
  require 'Dbconnection.php';
extract($_POST);

 $Res = $db->query("select Montant from suggestion where Id_vendeur=".$id_vendeur." AND id_acheteur=".$id_acheteur)->fetch();
 return $Res["Montant"];
}

function Carte_Vendeur()
{require 'Dbconnection.php';
extract($_POST);

 $Res = $db->query("select CarteValeur from vendeur where IdVendeur=".$id_vendeur)->fetch();
 return $Res["CarteValeur"];
}

function Carte_Acheteur()
{require 'Dbconnection.php';
extract($_POST);

 $Res = $db->query("select CarteValeur from Acheteur where IdAcheteur=".$id_acheteur)->fetch();
 return $Res["CarteValeur"];
}

function Add_In_Transaction() {
require 'Dbconnection.php';
  extract($_POST);
 $db->query(" INSERT INTO TRANSACTION VALUES(".$id_vendeur.",".$id_acheteur.",now(),".MONTATNT_VALIDATE().",".Carte_Vendeur().",".Carte_Acheteur().",".$v_partie.") " ) ;

 $db->query("Update parameters set VALUE = VALUE + 1 where PARAMETER ='S".Carte_Vendeur()."'");
 $db->query("Update parameters set VALUE = VALUE + 1 where PARAMETER ='B".Carte_Acheteur()."'");
 $db->exec("delete from suggestion where id_vendeur=".$id_vendeur." AND id_acheteur=".$id_acheteur);
 $db->exec("delete from chat where idvendeur=".$id_vendeur." AND idacheteur=".$id_acheteur."");
 $bcards = array(
      "75" => "0",
      "65" => "0",
      "60" => "0",
      "50" => "0",
      "40" => "0");
  $scards = array(
      "80" => "0",
      "75" => "0",
      "70" => "0",
      "60" => "0",
      "50" => "0",
      "45" => "0",
      "35" => "0");

$stmt = $db->query("select PARAMETER , VALUE from parameters where ( PARAMETER LIKE 'S%' Or PARAMETER LIKE 'B%' ) AND PARAMETER NOT LIKE 'st%' ")->fetchAll();
  foreach ($stmt as $key) {
  $TYPE = substr($key["PARAMETER"],0,1);
  $index = substr($key["PARAMETER"],1);
  switch($TYPE)
  {
    Case 'B' :   $bcards[$index] =   $key["VALUE"];          break;
    Case 'S' :   $scards[$index] =   $key["VALUE"];
    # code...
  }

}

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
        echo "novelle carte vendeur ".$var;
        $db->exec("UPDATE  acheteur SET  CarteValeur =  ".(int)$var." WHERE  IdAcheteur = ".$id_acheteur);
        $db->exec("UPDATE  parameters SET  VALUE =  '".$bcards[$var]."' WHERE PARAMETER = 'B".$var."'");
      }
    }
    $picked = False;

    while($picked == False){
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
      if($scards[$var] == "0") $picked = False;
      else{
        $picked = True;
        echo "novelle carte Acheteur ".$var;
        $scards[$var] = (((int)$scards[$var])-1)+"";
        $db->exec("UPDATE  vendeur SET  CarteValeur =  ".(int)$var." WHERE  IdVendeur = ".$id_vendeur);
        $db->exec("UPDATE  parameters SET  VALUE =  '".$scards[$var]."' WHERE PARAMETER = 'S".$var."'");
      }
    }


}
?>
