<?php
	require 'Dbconnection.php';
	$stmt = $db->exec("delete from parameters where 1=1");
	$stmt = $db->exec("INSERT INTO `parameters` (`PARAMETER`, `VALUE`) VALUES
		('AdminPassword', '123456789'),
		('gameState', '0'),
		('partyTime', '10'),
		('B75', '2'),
		('B65', '4'),
		('B60', '12'),
		('B50', '11'),
		('B40', '7'),
		('S80', '2'),
		('S75', '4'),
		('S70', '8'),
		('S60', '6'),
		('S50', '5'),
		('S45', '7'),
		('S35', '4'),
		('party', '3'),
		('partyState', '1'),
		('startTime', '')");

?>
