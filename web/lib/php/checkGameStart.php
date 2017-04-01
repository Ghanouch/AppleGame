<?php
	require 'Dbconnection.php';
	$stmt = $db->query("select value from PARAMETERS where PARAMETER = 'gameState'");
	if( $stmt->rowCount()  == 0 ) echo "ERROR";
	else{
		foreach($stmt as $row) {
			echo $row['value'];
		}
	}
?>
