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
        $table_name = $_REQUEST['table_name'];
		$sql = "select * from $table_name";
		$result = $connection->query($sql);
		if($result == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error: {$info[2]}</p>");
			exit();
		}
		echo("<table>");
		
        echo("<h3>Table: $table_name</h3>\n");
        
        foreach ($result as $row) /* shows the selected table */
        {	
            echo("<tr>");
            for($i=0; $i < count($row); $i++)
            {
                echo("<td>$row[$i]</td>");
            }
            echo("</tr>\n");
		}
		echo("</table>");
		
		echo("<p><a href=\"tables.php\">Back to tables</a></p>");
		echo("<p><a href=\"main.php\">Back to main menu</a></p>");

		$connection = null;
?>
	</body>
</html>