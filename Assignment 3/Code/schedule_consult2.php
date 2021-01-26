<html>
    <body>
<?php
		$host = "db.tecnico.ulisboa.pt";
		$user = "";
		$pass = "";
		$dsn = "mysql:host=$host;dbname=$user";

		try
		{
			$connection = new PDO($dsn, $user, $pass);
		}
		catch(PDOException $exception)
		{
			echo("<p>Error: ");
			echo($exception->getMessage());
			echo("</p>");
			exit();
		}
        
        $animal_name = $_REQUEST['animal_name'];
        $owner_vat = $_REQUEST['owner_vat'];
        $client_vat = $_REQUEST['client_vat'];
        $date = $_REQUEST['date'];
        $vet_vat = $_REQUEST['vet_vat'];

		$sql = $connection->prepare("select * from veterinary where VAT = ?");
        if($sql == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error1: {$info[2]}</p>\n");
			exit();
		}
		$sql->execute([$vet_vat]);
		$result = $sql->fetchAll();
		$sql->null;
		
		if (!$result && $vet_vat != '')		/* if vet doesnt exist and the field was not left in blank */
		{
			echo("<p>Veterinary VAT does not exist</p>\n");
			echo("<p><a href=\"schedule_consult1.php?animal_name=$animal_name&client_VAT=$client_vat&owner_VAT=$owner_vat\">Schedule consult</a></p>");
			echo("<p><a href=\"main.php\">Back to main menu</a></p>");
		}
		else
		{
			$sql2 = $connection->prepare("select * from client where VAT = ?");
			if($sql2 == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error2: {$info[2]}</p>\n");
				exit();
			}
			$sql2->execute([$client_vat]);
			$result2 = $sql2->fetchAll();
			$sql2->null;
			
			if (!$result2)	/* if client doesnt exist */
			{
				echo("<p>Client VAT does not exist.</p>\n");
				echo("<p><a href=\"schedule_consult1.php?animal_name=$animal_name&client_VAT=$client_vat&owner_VAT=$owner_vat\">Schedule consult</a></p>");
				echo("<p><a href=\"register_client1.php?client_VAT=$client_vat\">Register client</a></p>");
				echo("<p><a href=\"main.php\">Back to main menu</a></p>");
			}
			else
			{
				$sql3 = $connection->prepare("select * from client where VAT = ?");
				if($sql3 == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error3: {$info[2]}</p>\n");
					exit();
				}
				$sql3->execute([$owner_vat]);
				$result3 = $sql3->fetchAll();
				$sql3->null;
				
				if (!$result3)	/* if owner doesnt exist */
				{
					echo("<p>Owner VAT does not exist.</p>\n");
					echo("<p><a href=\"schedule_consult1.php?animal_name=$animal_name&client_VAT=$client_vat&owner_VAT=$owner_vat\">Schedule consult</a></p>");
					echo("<p><a href=\"register_client1.php?client_VAT=$owner_vat\">Register owner</a></p>");
					echo("<p><a href=\"main.php\">Back to main menu</a></p>");
				}
				else
				{
					$sql4 = $connection->prepare("select * from animal where VAT = ? and name = ?");
					if($sql4 == FALSE)
					{
						$info = $connection->errorInfo();
						echo("<p>Error4: {$info[2]}</p>\n");
						exit();
					}
					$sql4->execute([$owner_vat, $animal_name]);
					$result4 = $sql4->fetchAll();
					$sql4->null;
					
					if (!$result4)	/* if animal doesnt exist */
					{
						echo("<p>Animal does not exist.</p>\n");
						echo("<p><a href=\"schedule_consult1.php?animal_name=$animal_name&client_VAT=$client_vat&owner_VAT=$owner_vat\">Schedule consult</a></p>");
						echo("<p><a href=\"register_animal1.php?animal_name=$animal_name&client_VAT=$client_vat\">Register animal</a></p>");
						echo("<p><a href=\"main.php\">Back to main menu</a></p>");
					}
					else
					{
						$sql5 = $connection->prepare("select * from consult where date_timestamp = ? and name = ? and vat_owner = ?");
						if($sql5 == FALSE)
						{
							$info = $connection->errorInfo();
							echo("<p>Error5: {$info[2]}</p>\n");
							exit();
						}
						$sql5->execute([$date, $animal_name, $owner_vat]);
						$result5 = $sql5->fetchAll();
						$sql5->null;
					
						if (!$result5)	/* if consult doesnt exist */
						{
							if($vet_vat == '')		/* if vet field was left in blank */
							{
								$sql6 = $connection->prepare("insert into consult(name, VAT_owner, date_timestamp, VAT_client) values(?, ?, ?, ?)");
								if($sql6 == FALSE)
								{
									$info = $connection->errorInfo();
									echo("<p>Error6: {$info[2]}</p>\n");
									exit();
								}
								$sql6->execute([$animal_name, $owner_vat, $date, $client_vat]);		/* insert row in consult without vet vat */
								$sql6->null;	
							}
							else		/* if vet field was specified */
							{						
								$sql7 = $connection->prepare("insert into consult(name, VAT_owner, date_timestamp, VAT_client, VAT_vet) values(?, ?, ?, ?, ?)");
								if($sql7 == FALSE)
								{
									$info = $connection->errorInfo();
									echo("<p>Error7: {$info[2]}</p>\n");
									exit();
								}
								$sql7->execute([$animal_name, $owner_vat, $date, $client_vat, $vet_vat]);		/* insert row in consult with vet vat */
								$sql7->null;	
							}
							echo("<p>Consult scheduled.</p>\n");
							echo("<p><a href=\"main.php\">Back to main menu</a></p>");						
						}
						else
						{
							echo("<p>Consult was already scheduled.</p>\n");
							echo("<p><a href=\"schedule_consult1.php?animal_name=$animal_name&client_VAT=$client_vat&owner_VAT=$owner_vat\">Schedule consult</a></p>");
							echo("<p><a href=\"main.php\">Back to main menu</a></p>");	
						}
					}
				}
			}
		}
		$connection = null;
?>
    </body>
</html>