<html>
    <body>
        <h3>Search for consults of a specific animal</h3>
        
        <form action="consult_list.php" method="post">
            <p>Animal Name:<input type="text" name="animal_name"/></p>
            <p>Owner VAT:<input type="text" name="vat_owner"/></p>
            <input type="submit" value="Access"/>
        </form>
		
		<h3><p>Consults history</p></h3>
		
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
       
		$sql = "select * from consult;";
		
        $result = $connection->query($sql);
        if($result == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error: {$info[2]}</p>\n");
			exit();
		}
        
        echo("<table border=\"1\">\n");
        
        echo("<tr><td>Name</td><td>Owner VAT</td><td>Consult Date</td><td>Subjective Observation</td><td>Objective Observation</td><td>Assessment</td><td>Plan</td><td>Client VAT</td><td>Veterinary VAT</td><td>Weight</td></tr>");
        
        foreach($result as $row)		/* shows consult table entirely */
        {
			$animal_name = $row['name'];
			$vat_owner = $row['VAT_owner'];
            echo("<tr>\n");
            
            echo("<td>");
            echo("<a href=\"consult_list.php?animal_name=$animal_name&vat_owner=$vat_owner\">{$row['name']}</a>");
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
			
			echo("<td>");
            echo($row['o']);
            echo("</td>");
			
			echo("<td>");
            echo($row['a']);
            echo("</td>");
			
			echo("<td>");
            echo($row['p']);
            echo("</td>");
			
			echo("<td>");
            echo($row['VAT_client']);
            echo("</td>");
			
			echo("<td>");
            echo($row['VAT_vet']);
            echo("</td>");
			
			echo("<td>");
            echo($row['weight']);
            echo("</td>");
            
            echo("</tr>\n");
        }
        
        echo("</table>\n");
		
		echo("<p><a href=\"main.php\">Back to main menu</a></p>");
        
		$connection = null;
?>
    </body>
</html>