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
        $consult_date = $_REQUEST['consult_date'];
		$code = $_REQUEST['code'];
		
		/* inserts diagnostic code into consult diagnosis */
		$sql = "insert into consult_diagnosis(code, name, VAT_owner, date_timestamp) values('$code', '$animal_name', '$vat_owner', '$consult_date');";

		$result = $connection->query($sql);
		if($result == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error1: {$info[2]}</p>\n");
			exit();
		}
			
		echo("<p>Code added.</p>");
		
		echo("<a href=\"consult_details.php?animal_name=$animal_name&vat_owner=$vat_owner&consult_date=$consult_date=\">Back to consult details</a>");
        
		$connection = null;
?>   
        
    </body>
</html>		