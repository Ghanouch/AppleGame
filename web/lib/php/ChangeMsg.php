<?php
require 'Dbconnection.php';
extract($_POST);
$db->query("INSERT INTO chat VALUES(".$id_vendeur.",".$id_acheteur.",now(),'".$Message."',".$Type_Msg.") "); 

?>