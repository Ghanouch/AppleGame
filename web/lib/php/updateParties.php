<?php
	require 'Dbconnection.php';
	if(isset($_POST["updateState"])){
		$db->exec("UPDATE  parameters SET  VALUE = '0' WHERE  PARAMETER =  'partyState'");
		$db->exec("UPDATE  parameters SET  VALUE = '".$_POST["updateState"]."' WHERE  PARAMETER =  'party'");
	}
	if(isset($_POST["update"])){
			$db->exec("UPDATE  parameters SET  VALUE = now() WHERE  PARAMETER =  'startTime'");
			$db->exec("UPDATE  parameters SET  VALUE = '1' WHERE  PARAMETER =  'partyState'");
	}else{
		$stmt = $db->query("select value from PARAMETERS where PARAMETER = 'partyTime' ")->fetch();
		echo $stmt["value"]."|";
		$stmt = $db->query("select value from PARAMETERS where PARAMETER = 'startTime' ")->fetch();
		echo $stmt["value"]."|";
		$stmt = $db->query("select value from PARAMETERS where PARAMETER = 'party' ")->fetch();
		echo $stmt["value"]."|";
		$stmt = $db->query("select value from PARAMETERS where PARAMETER = 'partyState' ")->fetch();
		echo $stmt["value"]."|";
	}
?>
