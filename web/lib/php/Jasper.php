<?php
//Import the PhpJasperLibrary
include_once("../PhpJasperLibrary/tcpdf/tcpdf.php");
include_once("../PhpJasperLibrary/PHPJasperXML.inc.php");
require 'Dbconnection.php';
function Generer_PDF_Vendeur($Parametre,$NOM_PDF)
{

//database connection details

$server="localhost";
$db="apple_game";
$user="root";
$pass="";
//$version="0.8b";
$pgport=3306;
$pchartfolder="./class/pchart2";


//display errors should be off in the php.ini file
ini_set('display_errors', 0);

//setting the path to the created jrxml file
$xml =  simplexml_load_file("../../Repports/Vendeur.jrxml");

$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("ID_Vendeur"=>$Parametre);
$PHPJasperXML->xml_dismantle($xml);

            header('Content-Transfer-Encoding: binary');


$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I",$NOM_PDF.".PDF");    //page output method I:standard output  D:Download file

}

function Generer_PDF_Acheteur($Parametre,$NOM_PDF)
{

//database connection details

$server="localhost";
$db="apple_game";
$user="root";
$pass="";
//$version="0.8b";
$pgport=3306;
$pchartfolder="./class/pchart2";


//display errors should be off in the php.ini file
ini_set('display_errors', 0);

//setting the path to the created jrxml file
$xml =  simplexml_load_file("../../Repports/Acheteur.jrxml");

$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("ID_Acheteur"=>$Parametre);
$PHPJasperXML->xml_dismantle($xml);

            header('Content-Transfer-Encoding: binary');


$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I",$NOM_PDF.".PDF");    //page output method I:standard output  D:Download file

}

function Generer_PDF_Transaction()
{
$server="localhost";
$db="apple_game";
$user="root";
$pass="";
//$version="0.8b";
$pgport=3306;
$pchartfolder="./class/pchart2";


//display errors should be off in the php.ini file
ini_set('display_errors', 0);

//setting the path to the created jrxml file
$xml =  simplexml_load_file("../../Repports/Transaction.jrxml");

$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;

$PHPJasperXML->xml_dismantle($xml);

            header('Content-Transfer-Encoding: binary');

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I","All Transaction Statistique.PDF");    //page output method I:standard output  D:Download file
}

//Generer_PDF_Vendeur(1,"Issam");
//Generer_PDF_Transaction();
session_start();
extract($_GET);
$file_name = $_GET['page_name'];

if($file_name == 'Transaction')
{
	Generer_PDF_Transaction();
}
else
{
	$id =  ( $file_name == 'vendeur' ) ? 'Idvendeur' : 'IdAcheteur' ;
    $stmt = $db->query("select Surnom from ".$file_name." where ".$id."=".$id_player)->fetch();

 if($file_name == 'vendeur')
   Generer_PDF_Vendeur($id_player,$stmt["Surnom"]);
 else
  Generer_PDF_Acheteur($id_player,$stmt["Surnom"]);

}

?>
