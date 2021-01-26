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
        $VAT_owner = $_REQUEST['owner_vat'];
        $date_timestamp = $_REQUEST['date'];
        $s = $_REQUEST['s'];
        $o = $_REQUEST['o'];
        $a = $_REQUEST['a'];
        $p = $_REQUEST['p'];
        $VAT_client = $_REQUEST['client_vat'];
        $VAT_vet = $_REQUEST['vet_vat'];
        $weight = $_REQUEST['weight'];
		
		$sql = $connection->prepare("select * from veterinary where VAT = ?");
		if($sql == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error1: {$info[2]}</p>\n");
			exit();
		}
		$sql->execute([$VAT_vet]);
		$result = $sql->fetchAll();
		$sql->null;
		
		if (!$result)		/* if there is no vet */
		{
			echo("<p>Invalid veterinary VAT.</p>");
			echo("<p><a href=\"update_consult1.php?animal_name=$name&owner_vat=$VAT_owner&date_timestamp=$date_timestamp&s=$s&o=$o&a=$a&p=$p&VAT_client=$VAT_client&VAT_vet=$VAT_vet&weight=$weight\">Change Consult Details</a></p>");
		}
		else
		{
			$sql2 = $connection->prepare("update consult as c set s = ?, o = ?, a = ?, p = ?, VAT_vet = ?, weight = ? where name = ? and VAT_owner = ? and date_timestamp = ?");
			if($sql2 == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error2: {$info[2]}</p>\n");
				exit();
			}
			$sql2->execute([$s, $o, $a, $p, $VAT_vet, $weight, $name, $VAT_owner, $date_timestamp]);		/* update consult row */
			$sql2->null;
			echo("<p>Consult updated.</p>");
		}
			
		echo("<a href=\"consult_details.php?animal_name=$name&vat_owner=$VAT_owner&consult_date=$date_timestamp\">Back to consult details.</a>");
		
		$connection = null;
?>
    </body>
</html>