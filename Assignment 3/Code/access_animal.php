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
        $client_VAT = $_REQUEST['client_VAT'];
        $owner_name = $_REQUEST['owner_name'];
		
		if($animal_name == '' || $client_VAT == '')
		{
			echo("<p>Please fill both fields 'Animal Name' and 'Client VAT'.</p>");
			echo("<p><a href=\"register_animal0.php\">Register Animal</a></p>");
		}
		else
		{
			$sql = $connection->prepare("select * from client where VAT = ?");
			if($sql == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error1: {$info[2]}</p>\n");
				exit();
			}
			$sql->execute([$client_VAT]);
			
			$result = $sql->fetchAll();
			$sql->null;
			
			if (!$result)		/* if vat isnt found in client table */
			{
				echo "<p>Client VAT not found.</p>";
				echo("<a href=\"register_client1.php?client_VAT=$client_VAT\">Register client</a>");
			}
			else
			{
				$sql2 = $connection->prepare("select a.name as animal_name, p.VAT, p.name, species_name, colour, gender from person as p, animal as a where a.name = ? and LOCATE(?, p.name) and a.VAT = p.VAT");
				if($sql2 == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error2: {$info[2]}</p>\n");
					exit();
				}
				$sql2->execute([$animal_name, $owner_name]);
				$result2 = $sql2->fetchAll();
				$sql2->null;
				
				if (!$result2)		/* if animal isnt found in animal table */
				{
					echo "<p>Animal not found.</p>";
					echo("<a href=\"register_animal0.php?animal_name=$animal_name&client_VAT=$client_VAT\">Register new animal assuming client as animal owner</a>");
				}
				else
				{
					
					echo("<p><H3>All matching animals</H3></p>");
				
					echo("<table border=\"1\">\n");
					
					echo("<tr><td>Animal Name</td><td>Species</td><td>Colour</td><td>Gender</td><td>Owner VAT</td><td>Owner Name</td><td></td><td></td></tr>");
					
					foreach($result2 as $row2)		/* show all animals with corresponding animal name and part of owner name */
					{
						$owner_VAT = $row2['VAT'];
						
						echo("<tr>\n");
						
						echo("<td>");
						echo($row2['animal_name']);
						echo("</td>");

						echo("<td>");
						echo($row2['species_name']);
						echo("</td>");

						echo("<td>");
						echo($row2['colour']);
						echo("</td>");

						echo("<td>");
						echo($row2['gender']);
						echo("</td>");
						
						echo("<td>");
						echo($row2['VAT']);
						echo("</td>");
						
						echo("<td>");
						echo($row2['name']);
						echo("</td>");
				
						echo("<td>");
						echo("<a href=\"consult_list.php?animal_name=$animal_name&vat_owner=$owner_VAT\">Consult List</a>");
						echo("</td>");

						echo("<td>");
						echo("<a href=\"schedule_consult1.php?animal_name=$animal_name&client_VAT=$client_VAT&owner_VAT=$owner_VAT\">Schedule consult</a>");
						echo("</td>");

						echo("</tr>\n");
					}
					
					echo("<table>");
					
					echo("<a href=\"register_animal1.php?animal_name=$animal_name&client_VAT=$client_VAT\">Register new animal</a>");
					
					echo("<p><H3>All matching animals that Client VAT:$client_VAT has accompanied to consults</H3></p>");
				
					$sql3 = $connection->prepare("select distinct c.name as animal_name, p.VAT, p.name, species_name from person as p, consult as c, animal as a where c.name = ? and LOCATE(?, p.name) and VAT_owner = p.VAT and VAT_client = ? and a.name = c.name and a.VAT = p.VAT");
					if($sql3 == FALSE)
					{
						$info = $connection->errorInfo();
						echo("<p>Error3: {$info[2]}</p>\n");
						exit();
					}
					$sql3->execute([$animal_name, $owner_name, $client_VAT]);
					$result3 = $sql3->fetchAll();
					$sql3->null;
					
					if (!$result3)		/* if client hasnt taken any of the matching animals from before to consults */
					{
						echo "<p>No matching animals.</p>";
					}
					else
					{
						echo("<table border=\"1\">\n");
						
						echo("<tr><td>Animal Name</td><td>Species</td><td>Owner VAT</td><td>Owner Name</td></tr>");
						
						foreach($result3 as $row3)		/* show all animals whom the client has taken to consults */
						{
							echo("<tr>\n");
							
							echo("<td>");
							echo($row3['animal_name']);
							echo("</td>");
							
							echo("<td>");
							echo($row3['species_name']);
							echo("</td>");
							
							echo("<td>");
							echo($row3['VAT']);
							echo("</td>");
							
							echo("<td>");
							echo($row3['name']);
							echo("</td>");

							echo("</tr>\n");
						}
						
						echo("<table>");

						$sql4 = $connection->prepare("select c.name as animal_name, p.VAT, p.name, species_name, date_timestamp, s, VAT_client from person as p, consult as c, animal as a where c.name = ? and LOCATE(?, p.name) and VAT_owner = p.VAT and VAT_client = ? and a.name = c.name and a.VAT = p.VAT");
						if($sql4 == FALSE)
						{
							$info = $connection->errorInfo();
							echo("<p>Error4: {$info[2]}</p>\n");
							exit();
						}
						$sql4->execute([$animal_name, $owner_name, $client_VAT]);
						$result4 = $sql4->fetchAll();
						$sql4->null;
						
						echo("<p><H3>All consult records that Client VAT:$client_VAT was present with matching animals</H3></p>");
					
						echo("<table border=\"1\">\n");
						
						echo("<tr><td>Animal Name</td><td>Species</td><td>Owner VAT</td><td>Owner Name</td><td>Consult Date</td><td>Subjective Observation</td></tr>");
						
						foreach($result4 as $row4)		/* show the details of all the consults mentioned before */
						{
							echo("<tr>\n");
							
							echo("<td>");
							echo($row4['animal_name']);
							echo("</td>");
							
							echo("<td>");
							echo($row4['species_name']);
							echo("</td>");
							
							echo("<td>");
							echo($row4['VAT']);
							echo("</td>");
							
							echo("<td>");
							echo($row4['name']);
							echo("</td>");
							
							echo("<td>");
							echo($row4['date_timestamp']);
							echo("</td>");
							
							echo("<td>");
							echo($row4['s']);
							echo("</td>");

							echo("</tr>\n");
						}
						
						echo("<table>");
					}
				}			
			}
		}
        echo("<p><a href=\"find_animal.php?VAT=$client_VAT\">Back to find an animal</a></p>");
        echo("<p><a href=\"main.php\">Back to main menu</a></p>");
		
		$connection = null;
?>
    </body>
</html>