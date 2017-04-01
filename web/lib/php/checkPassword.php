<?php
	require 'Dbconnection.php';
	extract($_POST);
	$stmt = $db->query("select value from PARAMETERS where PARAMETER = 'AdminPassword'")->fetch();
	if($password == $stmt["value"]) {
		echo "1";
		session_start();
		$_SESSION["admin"] = "logged";
	}
	else echo "0";
?>