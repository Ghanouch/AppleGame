<?php

//Import the PhpJasperLibrary
include_once('../PhpJasperLibrary/tcpdf/tcpdf.php');
include_once("../PhpJasperLibrary/PHPJasperXML.inc.php");
 
 
//database connection details
 
$server="127.0.0.1";
$db="apple_game";
$user="root";
$pass="";
$version="0.8b";
//$pgport=3306;
//$pchartfolder="./class/pchart2";
 
 
//display errors should be off in the php.ini file
ini_set('display_errors', 0);
 
//setting the path to the created jrxml file
$xml =  simplexml_load_file("../../Repports/Vendeur.jrxml");
 
$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("ID_Vendeur"=>3);
$PHPJasperXML->xml_dismantle($xml);
 
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file

?>