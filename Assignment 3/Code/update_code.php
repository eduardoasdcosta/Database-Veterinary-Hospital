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
		
		echo("<p><h3>Diagnostic codes:</h3></p>");
		echo("<p><h4>Selected diagnostic codes:</h4></p>");
		
		echo("</table>\n");
		
		$sql = "select * from diagnosis_code where code in(SELECT d.code from diagnosis_code as d, consult_diagnosis as c where c.code = d.code and c.name = '$animal_name' and c.VAT_owner = '$vat_owner' and c.date_timestamp = '$consult_date');";

        $result = $connection->query($sql);
        if($result == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error1: {$info[2]}</p>\n");
			exit();
		}
		
		$count = $result->rowCount();
			
		if ($count == 0)		/* if consult has no diagnostic codes */
		{
			echo "<p>Consult has no diagnostic codes associated<p>";
		}
		else
		{
			echo("<table border=\"1\">\n");
				
			echo("<tr><td>Code</td><td>Name</td><td></td></tr>");
				
			foreach($result as $row)		/* show all diagnostic codes associated to consult */
			{
				$code = $row['code'];
				
				echo("<tr>\n");
					
				echo("<td>");
				echo($row['code']);
				echo("</td>");
					
				echo("<td>");
				echo($row['name']);
				echo("</td>");
					
				echo("<td>");
				echo("<a href=\"remove_code.php?animal_name=$animal_name&vat_owner=$vat_owner&consult_date=$consult_date&code=$code\">Remove Code</a>");
				echo("</td>");
					
				echo("</tr>\n");
			}
			
			echo("</table>\n");
		}
		
		echo("<p><h4>List of remaining diagnostic codes:</h4></p>");
		
		$sql2 = "select * from diagnosis_code where code not in(SELECT d.code from diagnosis_code as d, consult_diagnosis as c where c.code = d.code and c.name = '$animal_name' and c.VAT_owner = '$vat_owner' and c.date_timestamp = '$consult_date');";

        $result2 = $connection->query($sql2);
        if($result2 == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error2: {$info[2]}</p>\n");
			exit();
		}
		
		$count2 = $result2->rowCount();
			
		if ($count2 == 0)			/* if there arent diagnostic codes left to associate to the consult */
		{
			echo "<p>No diagnostic codes left to be associated to consult<p>";
		}
		else
		{
			echo("<table border=\"1\">\n");
				
			echo("<tr><td>Code</td><td>Name</td><td></td></tr>");
				
			foreach($result2 as $row2)		/* show all diagnostic codes remaining to associate to the consult */
			{
				$code = $row2['code'];
				
				echo("<tr>\n");
					
				echo("<td>");
				echo($row2['code']);
				echo("</td>");
					
				echo("<td>");
				echo($row2['name']);
				echo("</td>");
					
				echo("<td>");
				echo("<a href=\"add_code.php?animal_name=$animal_name&vat_owner=$vat_owner&consult_date=$consult_date&code=$code\">Add Code</a>");
				echo("</td>");
					
				echo("</tr>\n");
			}
			
			echo("</table>\n");
        }
		
		echo("<p><a href=\"consult_details.php?animal_name=$animal_name&vat_owner=$vat_owner&consult_date=$consult_date\">Back to consult details</a></p>");
		
		$connection = null;
?>   
        
    </body>
</html>		
       