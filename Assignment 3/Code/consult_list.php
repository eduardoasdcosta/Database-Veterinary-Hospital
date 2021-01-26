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
        $vat_owner = $_REQUEST['vat_owner'];

		$sql = $connection->prepare("select * from animal where name = ? and VAT = ?");
		
		if ($sql == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error2: {$info[2]}</p>");
			exit();
		}
		
		$sql->execute([$animal_name, $vat_owner]);
		$result = $sql->fetchAll();
		$sql->null;

		if (!$result)		/* if animal doesnt exist */
		{
			echo("<p>Animal doesnt exist<p>");
			echo("<p><a href=\"register_animal1.php?animal_name=$animal_name&client_VAT=$vat_owner\">Register animal</a></p>");
		}
		else
		{
			$sql2 = $connection->prepare("select * from consult where name = ? and VAT_owner = ?");
			
			if ($sql2 == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error2: {$info[2]}</p>");
				exit();
			}
			
			$sql2->execute([$animal_name, $vat_owner]);
			$result2 = $sql2->fetchAll();
			$sql2->null;

			if (!$result2)		/* if animal has never been in a consult before */
			{
				echo("<p>Animal has no consults history<p>");
				echo("<p><a href=\"schedule_consult1.php?animal_name=$animal_name&owner_VAT=$vat_owner\">Schedule consult</a></p>");
			}
			else
			{
				echo("<table border=\"1\">\n");
				
				echo("<tr><td>Name</td><td>Owner VAT</td><td>Consult Date</td><td></td><td></td></tr>");
				
				foreach($result2 as $row)		/* lists all consults of the animal */
				{
					echo("<tr>\n");
					
					echo("<td>");
					echo($row['name']);
					echo("</td>");
					
					echo("<td>");
					echo($row['VAT_owner']);
					echo("</td>");
					
					echo("<td>");
					echo($row['date_timestamp']);
					echo("</td>");
					
					echo("<td>");
					echo("<a href=\"consult_details.php?animal_name=$animal_name&vat_owner=$vat_owner&consult_date={$row['date_timestamp']}\">Consult details</a>");
					echo("</td>");
					
					echo("<td>");
					echo("<a href=\"blood_test_results.php?animal_name=$animal_name&vat_owner=$vat_owner&consult_date={$row['date_timestamp']}\">Enter results of a blood test</a>");
					echo("</td>");
					
					echo("</tr>\n");
				}
			}
			echo("</table>\n");
		}
		echo("<p><a href=\"consults.php\">Search a consult</a></p>");
		echo("<p><a href=\"main.php\">Back to main menu</a></p>");
        
		$connection = null;
?>
    </body>
</html>