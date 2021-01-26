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
        $owner_VAT = $_REQUEST['owner_VAT'];
        $consult_date = $_REQUEST['consult_date'];

        $assist_VAT = $_REQUEST['assist_VAT'];
        $acidosis = $_REQUEST['acidosis'];
        $cholesterol = $_REQUEST['cholesterol'];
        $creatinine = $_REQUEST['creatinine'];
        $glucose = $_REQUEST['glucose'];

        $vat_verify = $connection->prepare("select VAT from assistant where VAT = ?");

		if ($vat_verify == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>ErrorVAT: {$info[2]}</p>");
			exit();
		}
		
		$vat_verify->execute([$assist_VAT]);
		$verify = $vat_verify->fetchAll();
		$vat_verify->null;

		if (!$verify)  /* if vat doesnt exist in assistant */
        {
            echo("Inserted VAT does not match with any assistant.\n");
            echo("Couldn't insert blood test results.\n");
        }
        else
        {
            $sql = $connection->prepare("select max(num) from medical_procedure where name = ? and VAT_owner = ? and date_timestamp = ?");
			if ($sql == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error0: {$info[2]}</p>");
				exit();
			}
            $sql->execute([$animal_name, $owner_VAT, $consult_date]);		/* find the highest 'num' associated to consult */
			$result = $sql->fetchAll();
			$sql->null;

            // Result is a table with column 'max(num)' and respective value, to acquire value iteration is needed
            
            foreach($result as $row)		/* get current 'num' value */
            {   
                if($row['max(num)'] == NULL)
                {
                    $num = 0;
                    break;
                }
                else
                {
                    $num = $row['max(num)'] + 1;
                    break;
                }
            }
			
			
			$connection->beginTransaction();
			
            $sql1 = $connection->prepare("insert into medical_procedure(name, VAT_owner, date_timestamp, num, description) values(?, ?, ?, ?, 'blood test procedure')");
            if($sql1 == FALSE)
            {
                $info = $connection->errorInfo();
                echo("<p>Error1: {$info[2]}</p>\n");
                exit();
            }
			$sql1->execute([$animal_name, $owner_VAT, $consult_date, $num]);	/* insert into medical_procedure the new row */
			$sql1->null;

            $sql2 = $connection->prepare("insert into performed(name, VAT_owner, date_timestamp, num, VAT_assistant) values(?, ?, ?, ?, ?)");
            if($sql2 == FALSE)
            {
                $info = $connection->errorInfo();
                echo("<p>Error2: {$info[2]}</p>\n");
                exit();
            }
			$sql2->execute([$animal_name, $owner_VAT, $consult_date, $num, $assist_VAT]);	/* insert into performed the new row */
			$sql2->null;
			
            $sql3 = $connection->prepare("insert into test_procedure(name, VAT_owner, date_timestamp, num, test_type) values(?, ?, ?, ?, 'blood')");
            if($sql3 == FALSE)
            {
                $info = $connection->errorInfo();
                echo("<p>Error3: {$info[2]}</p>\n");
                exit();
            }
			$sql3->execute([$animal_name, $owner_VAT, $consult_date, $num]);	/* insert into test_procedure the new row */
			$sql3->null;
			
			if(($acidosis == 0 || $acidosis == '') && ($cholesterol == 0 || $cholesterol == '') && ($creatinine == 0 || $creatinine == '') && ($glucose == 0 || $glucose == '')) /* if all fields are empty */
			{
				$connection->rollback();
				echo("Empty or invalid fields!\n");
				echo("Registration failed!\n");
			}
			else
			{
				if($acidosis != 0 && $acidosis != '')			/* if acidosis parameter isnt 0 or blank */
				{
					$sql4 = $connection->prepare("insert into produced_indicator(name, VAT_owner, date_timestamp, num, indicator_name, indicator_value) values(?, ?, ?, ?, 'Acidosis', ?)");
					if($sql4 == FALSE)
					{
						$info = $connection->errorInfo();
						echo("<p>Error4: {$info[2]}</p>\n");
						exit();
					}
					$sql4->execute([$animal_name, $owner_VAT, $consult_date, $num, $acidosis]);		/* insert into produced_indicator the current acidosis test values */
					$sql4->null;
				}
				
				if($cholesterol != 0 && $cholesterol != '')			/* if cholesterol parameter isnt 0 or blank */
				{
					$sql5 = $connection->prepare("insert into produced_indicator(name, VAT_owner, date_timestamp, num, indicator_name, indicator_value) values(?, ?, ?, ?, 'Cholesterol level', ?)");
					if($sql5 == FALSE)
					{
						$info = $connection->errorInfo();
						echo("<p>Error5: {$info[2]}</p>\n");
						exit();
					}
					$sql5->execute([$animal_name, $owner_VAT, $consult_date, $num, $cholesterol]);		/* insert into produced_indicator the current cholesterol test values */
					$sql5->null;
				}

				if($creatinine != 0 && $creatinine != '')			/* if creatinine parameter isnt 0 or blank */
				{
					$sql6 = $connection->prepare("insert into produced_indicator(name, VAT_owner, date_timestamp, num, indicator_name, indicator_value) values(?, ?, ?, ?, 'Creatinine level', ?)");
					if($sql6 == FALSE)
					{
						$info = $connection->errorInfo();
						echo("<p>Error6: {$info[2]}</p>\n");
						exit();
					}
					$sql6->execute([$animal_name, $owner_VAT, $consult_date, $num, $creatinine]);		/* insert into produced_indicator the current creatinine test values */
					$sql6->null;
				}            

				if($glucose != 0 && $glucose != '')			/* if glucose parameter isnt 0 or blank */
				{
					$sql7 = $connection->prepare("insert into produced_indicator(name, VAT_owner, date_timestamp, num, indicator_name, indicator_value) values(?, ?, ?, ?, 'Glucose level', ?)");
					if($sql7 == FALSE)
					{
						$info = $connection->errorInfo();
						echo("<p>Error7: {$info[2]}</p>\n");
						exit();
					}
					$sql7->execute([$animal_name, $owner_VAT, $consult_date, $num, $glucose]);		/* insert into produced_indicator the current glucose test values */
					$sql7->null;
				}
				
				$connection->commit();

				$sql8 = $connection->prepare("select indicator_name as Indicator, indicator_value as Value from produced_indicator where name = ? and VAT_owner = ? and date_timestamp = ? and num = ?");
				if($sql8 == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error8: {$info[2]}</p>\n");
					exit();
				}
				$sql8->execute([$animal_name, $owner_VAT, $consult_date, $num]);
				$result8 = $sql8->fetchAll();
				$sql8->null;

				echo("<p>Test results saved:</p>");
				
				echo("<table border=\"1\">\n");
				
				echo("<tr><td>Indicator</td><td>Value</td></tr>");

				foreach($result8 as $row)		/* show all indicators and respective values that were inserted in produced_indicator */
				{
					echo("<tr>\n");
						
					echo("<td>");
					echo($row['Indicator']);
					echo("</td>");

					echo("<td>");
					echo($row['Value']);
					echo("</td>");
					
					echo("</tr>\n");
				}

				echo("</table>\n");
			}
        }

        echo("<p><a href=\"blood_test_results.php?animal_name=$animal_name&vat_owner=$owner_VAT&consult_date=$consult_date\">Back to insert test results</a></p>");
        echo("<p><a href=\"consult_list.php?animal_name=$animal_name&vat_owner=$owner_VAT\">Back to consult list</a></p>");

        $connection = null; 
        
?>
    </body>
</html>