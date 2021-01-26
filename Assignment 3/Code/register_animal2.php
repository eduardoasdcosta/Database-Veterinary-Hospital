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
        
        $name = $_REQUEST['name'];
        $VAT = $_REQUEST['VAT'];
        $species_name = $_REQUEST['species_name'];
        $colour = $_REQUEST['colour'];
        $gender = $_REQUEST['gender'];
        $birth_year = $_REQUEST['birth_year'];
		
		if($name == '')
		{
			echo("<p>Please state a name for the animal.</p>");
			echo("<p><a href=\"register_animal1.php\">Register Animal</a></p>");
		}
		else
		{
			$sql = $connection->prepare("select * from client where vat = ?");
			if($sql == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error1: {$info[2]}</p>\n");
				exit();
			}
			$sql->execute([$VAT]);
			$result = $sql->fetchAll();
			$sql->null;
			
			if (!$result) 		/* if vat doesn't exist */
			{
				echo("<p>VAT innexistant</p>");
				echo("<a href=\"register_client1.php?client_VAT=$VAT\">Register client</a>");
				echo("<p><a href=\"register_animal1.php?animal_name=$name&client_VAT=$VAT\">Register animal</a></p>");
			}
			else
			{
				$sql2 = $connection->prepare("select * from animal where vat = ? and name = ?");
				if($sql2 == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error2: {$info[2]}</p>\n");
					exit();
				}
				$sql2->execute([$VAT, $name]);
				$result2 = $sql2->fetchAll();
				$sql2->null;
				
				if (!$result2)		/* if animal with same vat and name isnt already registered */
				{
					if($species_name == '' || $colour == '' || $gender == '' || $birth_year == '')
					{
						echo("<p>Please fill every field.</p>");
						echo("<p><a href=\"register_animal0.php?animal_name=$name&client_VAT=$VAT\">Register Animal</a></p>");
					}
					else
					{
						$sql3 = $connection->prepare("select * from species where name = ?");
						if($sql3 == FALSE)
						{
							$info = $connection->errorInfo();
							echo("<p>Error3: {$info[2]}</p>\n");
							exit();
						}
						$sql3->execute([$species_name]);
						$result3 = $sql3->fetchAll();
						$sql3->null;
						
						if (!$result3)		/* if species_name doesnt exist in species table */
						{
							$sql4 = $connection->prepare("insert into species(name) values(?)");
							if($sql4 == FALSE)
							{
								$info = $connection->errorInfo();
								echo("<p>Error4: {$info[2]}</p>\n");
								exit();
							}
							$sql4->execute([$species_name]);		/* inserts new species_name into species */
							$sql4->null;
						}
						
						$sql5 = $connection->prepare("insert into animal(name, VAT, species_name, colour, gender, birth_year) values(?, ?, ?, ?, ?, ?)");
						if($sql5 == FALSE)
						{
							$info = $connection->errorInfo();
							echo("<p>Error5: {$info[2]}</p>\n");
							exit();
						}
						
						$sql5->execute([$name, $VAT, $species_name, $colour, $gender, $birth_year]);		/* inserts new animal into the database */
						$sql5->null;
						echo "<p>Animal registered.</p>";
					}
				}
				else
				{
					echo "<p>Animal already registered.</p>";
				}			
			}
		}
        echo("<a href=\"main.php\">Back to main menu</a>");
		
		$connection = null;
?>
    </body>
</html>