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
        
        $sql = "select animal.name, animal.species_name, animal.gender, animal.age, animal.colour, consult.weight from animal, consult where animal.name = '$animal_name' and animal.VAT = $vat_owner and consult.date_timestamp = '$consult_date' and consult.name = animal.name and consult.VAT_owner = animal.VAT;";
        
        $result = $connection->query($sql);
        if($result == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error: {$info[2]}</p>\n");
			exit();
		}
        
        echo("<p><H3>Animal characteristics:</H3></p>");
        
        echo("<table border=\"1\">\n");
        
        echo("<tr><td>Name</td><td>Species</td><td>Gender</td><td>Age</td><td>Colour</td><td>Weight</td></tr>");
        
        foreach($result as $row)		/* shows animal characteristics */
        {	
            echo("<tr>\n");
            
            echo("<td>");
            echo($row['name']);
            echo("</td>");
            
            echo("<td>");
            echo($row['species_name']);
            echo("</td>");
            
            echo("<td>");
            echo($row['gender']);
            echo("</td>");
            
            echo("<td>");
            echo($row['age']);
            echo("</td>");
            
            echo("<td>");
            echo($row['colour']);
            echo("</td>");
            
            echo("<td>");
            echo($row['weight']);
            echo("</td>");
            
            echo("</tr>\n");
        }
        
        echo("</table>\n");
        
		$sql = "select * from consult where name = '$animal_name' and VAT_owner = $vat_owner and date_timestamp = '$consult_date';";
       
        $result = $connection->query($sql);
        if($result == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error: {$info[2]}</p>\n");
			exit();
		}
        
        echo("<p><H3>Consult Details:</H3></p>");
        
        echo("<table border=\"1\">\n");
        
        echo("<tr><td>Name</td><td>Owner VAT</td><td>Consult Date</td><td>Subjective Observation</td><td>Objective Observation</td><td>Assessment</td><td>Plan</td><td>Client VAT</td><td>Veterinary VAT</td><td>Weight</td></tr>");
        
        foreach($result as $row)			/* shows consult details */
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
            echo($row['s']);
            echo("</td>");
			$s = $row['s'];
            
            echo("<td>");
            echo($row['o']);
            echo("</td>");
			$o = $row['o'];
            
            echo("<td>");
            echo($row['a']);
            echo("</td>");
			$a = $row['a'];
            
            echo("<td>");
            echo($row['p']);
            echo("</td>");
			$p = $row['p'];
            
            echo("<td>");
            echo($row['VAT_client']);
            echo("</td>");
			$VAT_client = $row['VAT_client'];
            
            echo("<td>");
            echo($row['VAT_vet']);
            echo("</td>");
			$VAT_vet = $row['VAT_vet'];
            
            echo("<td>");
            echo($row['weight']);
            echo("</td>");
			$weight = $row['weight'];
            
            echo("</tr>\n");
        }
        
        echo("</table>\n");
		
        echo("<a href=\"update_consult1.php?animal_name=$animal_name&owner_vat=$vat_owner&date_timestamp=$consult_date&s=$s&o=$o&a=$a&p=$p&VAT_client=$VAT_client&VAT_vet=$VAT_vet&weight=$weight\">Change Consult Details</a>");
        
		echo("<p><H3>Diagnosis codes associated with consult:</H3></p>");
			
        $sql2 = "select d.code, d.name from consult_diagnosis as cd, diagnosis_code as d where cd.name = '$animal_name' and cd.VAT_owner = $vat_owner and cd.date_timestamp = '$consult_date' and d.code = cd.code;";
        
        $result2 = $connection->query($sql2);
        if($result2 == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error: {$info[2]}</p>\n");
			exit();
		}
		
		$count2 = $result2->rowCount();
		
		if ($count2 == 0)		/* if there are no diagnostic codes associated to the consult */
		{
			echo "<p>Consult has no diagnosis codes associated<p>";
		}
		else
		{
			echo("<table border=\"1\">\n");
			
			echo("<tr><td>Code</td><td>Name</td></tr>");
			
			foreach($result2 as $row2)			/* shows diagnostic codes associated to the consult */
			{
				echo("<tr>\n");
				
				echo("<td>");
				echo($row2['code']);
				echo("</td>");
				
				echo("<td>");
				echo($row2['name']);
				echo("</td>");
				
				echo("</tr>\n");
			}
			
			echo("</table>\n");
		}	
		
		echo("<a href=\"update_code.php?animal_name=$animal_name&vat_owner=$vat_owner&consult_date={$row['date_timestamp']}\">Update diagnostic codes</a>");	
		
		echo("<p><H3>Prescriptions associated with consult:</p></H3>");
		
        $sql3 = "select * from prescription where name = '$animal_name' and VAT_owner = $vat_owner and date_timestamp = '$consult_date';";

        $result3 = $connection->query($sql3);
        if($result3 == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error: {$info[2]}</p>\n");
			exit();
		}
		
		$count3 = $result3->rowCount();
			
		if ($count3 == 0)			/* if there are no prescriptions associated to the consult */
		{
			echo "<p>Consult has no prescriptions associated<p>";
		}
		else
		{
			echo("<table border=\"1\">\n");
			
			echo("<tr><td>Code</td><td>Name</td><td>Owner VAT</td><td>Consult Date</td><td>Medication Name</td><td>Laboratory</td><td>dosage</td><td>Regime</td></tr>");
			
			foreach($result3 as $row3)			/* shows prescriptions associated to the consult */
			{
				echo("<tr>\n");
				
				echo("<td>");
				echo($row3['code']);
				echo("</td>");
				
				echo("<td>");
				echo($row3['name']);
				echo("</td>");
				
				echo("<td>");
				echo($row3['VAT_owner']);
				echo("</td>");
				
				echo("<td>");
				echo($row3['date_timestamp']);
				echo("</td>");
				
				echo("<td>");
				echo($row3['name_med']);
				echo("</td>");
				
				echo("<td>");
				echo($row3['lab']);
				echo("</td>");
				
				echo("<td>");
				echo($row3['dosage']);
				echo("</td>");
				
				echo("<td>");
				echo($row3['regime']);
				echo("</td>");
				
				echo("</tr>\n");
			}
			
			echo("</table>\n");
		}	
		
		echo("<p><a href=\"consult_list.php?animal_name=$animal_name&vat_owner=$vat_owner\">Back to consult list</p></a>");
		echo("<p><a href=\"consults.php\">Search a consult</a></p>");
		echo("<p><a href=\"main.php\">Back to main menu</a></p>");
		
		$connection = null;
?>
    </body>
</html>