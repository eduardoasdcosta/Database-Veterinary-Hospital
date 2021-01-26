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
        
        $client_VAT = $_REQUEST['client_VAT'];
        $client_name = $_REQUEST['client_name'];
        $address_street = $_REQUEST['address_street'];
        $address_city = $_REQUEST['address_city'];
        $address_zip = $_REQUEST['address_zip'];
		
		if($client_VAT == '' || $client_name == '' || $address_street == '' || $address_city == '' || $address_zip == '')
		{
			echo("<p>Please fill every field.</p>");
			echo("<p><a href=\"register_client1.php?client_VAT=$client_VAT\">Register Client</a></p>");
		}
		else
		{
			$sql = $connection->prepare("select * from person where VAT = ?");
			if($sql == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error1: {$info[2]}</p>\n");
				exit();
			}
			$sql->execute([$client_VAT]);
			$result = $sql->fetchAll();
			$sql->null;
			
			if (!$result)		/* if vat isnt registered in person table */
			{
				$sql2 = $connection->prepare("insert into person(VAT, name, address_street, address_city, address_zip) values(?, ?, ?, ?, ?)");
				if($sql2 == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error2: {$info[2]}</p>\n");
					exit();
				}
				$sql2->execute([$client_VAT, $client_name, $address_street, $address_city, $address_zip]);		/* register in person table */
				$sql2->null;
				
				$sql3 = $connection->prepare("insert into client(VAT) values(?)");
				if($sql3 == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error3: {$info[2]}</p>\n");
					exit();
				}
				$sql3->execute([$client_VAT]);		/* register in client table */
				$sql3->null;	
				echo "<p>Client registered</p>";
			}
			else
			{
				$sql4 = $connection->prepare("select * from client where VAT = ?");
				if($sql4 == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error4: {$info[2]}</p>\n");
					exit();
				}
				$sql4->execute([$client_VAT]);
				$result4 = $sql4->fetchAll();
				$sql4->null;
				
				if (!$result4)		/* if vat isnt registered in client table */
				{
					$sql5 = $connection->prepare("insert into client(VAT) values(?)");
					if($sql5 == FALSE)
					{
						$info = $connection->errorInfo();
						echo("<p>Error5: {$info[2]}</p>\n");
						exit();
					}
					$sql5->execute([$client_VAT]);
					$sql5->null;
					echo "<p>Client registered</p>";
				}
				else
				{
					echo("<p>Client VAT already registered</p>\n");
					echo("<p><a href=\"register_client1.php\">Register client</a></p>");
				}
			}
		}		
		echo("<a href=\"main.php\">Back to main menu</a>");
		
		$connection = null;
?>
    </body>
</html>