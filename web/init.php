<?php
	require 'lib/php/Dbconnection.php';
	$stmt = $db->exec("delete from parameters where 1=1");
		$stmt = $db->exec("delete from suggestion where 1=1");
			$stmt = $db->exec("delete from transaction where 1=1");
				$stmt = $db->exec("delete from chat where 1=1");
				$stmt = $db->exec("delete from vendeur where 1=1");
					$stmt = $db->exec("delete from acheteur where 1=1");

					$stmt = $db->exec("	INSERT INTO `acheteur`(`Surnom`, `CarteValeur`, `clients`) VALUES ('Jack',50,0)");
						$stmt = $db->exec("	INSERT INTO `acheteur`(`Surnom`, `CarteValeur`, `clients`) VALUES ('Sarah',60,0)");
							$stmt = $db->exec("	INSERT INTO `acheteur`(`Surnom`, `CarteValeur`, `clients`) VALUES ('Lionard',70,0)");
								$stmt = $db->exec("	INSERT INTO `acheteur`(`Surnom`, `CarteValeur`, `clients`) VALUES ('Touhami',55,0)");
									$stmt = $db->exec("	INSERT INTO `acheteur`(`Surnom`, `CarteValeur`, `clients`) VALUES ('Alfred',20,0)");

									$stmt = $db->exec("	INSERT INTO `vendeur`(`Surnom`, `CarteValeur`, `clients`) VALUES ('Moha',45,0)");
									  $stmt = $db->exec("	INSERT INTO `vendeur`(`Surnom`, `CarteValeur`, `clients`) VALUES ('Edward',40,0)");
									    $stmt = $db->exec("	INSERT INTO `vendeur`(`Surnom`, `CarteValeur`, `clients`) VALUES ('Roula',75,0)");
									      $stmt = $db->exec("	INSERT INTO `vendeur`(`Surnom`, `CarteValeur`, `clients`) VALUES ('Bill',30,0)");
									        $stmt = $db->exec("	INSERT INTO `vendeur`(`Surnom`, `CarteValeur`, `clients`) VALUES ('Ronald',25,0)");

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
	session_start();
	session_destroy();
?>
