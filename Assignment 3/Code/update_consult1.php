<html>
    <body>
	
<?php
		$name = $_REQUEST['animal_name'];
        $VAT_owner = $_REQUEST['owner_vat'];
        $date_timestamp = $_REQUEST['date_timestamp'];
        $s = $_REQUEST['s'];
        $o = $_REQUEST['o'];
        $a = $_REQUEST['a'];
        $p = $_REQUEST['p'];
        $VAT_client = $_REQUEST['VAT_client'];
        $VAT_vet = $_REQUEST['VAT_vet'];
        $weight = $_REQUEST['weight'];
		
		echo("<p><H3>Current consult details:</H3></p>");
		
        echo("<table border=\"1\">\n");
        
        echo("<tr><td>Name</td><td>Owner VAT</td><td>Consult Date</td><td>Subjective Observation</td><td>Objective Observation</td><td>Assessment</td><td>Plan</td><td>Client VAT</td><td>Veterinary VAT</td><td>Weight</td></tr>");
        
		/* shows consult details */
		
        echo("<tr>\n");
            
        echo("<td>");
        echo($name);
        echo("</td>");
            
        echo("<td>");
        echo($VAT_owner);
        echo("</td>");
            
        echo("<td>");
        echo($date_timestamp);
        echo("</td>");
            
        echo("<td>");
        echo($s);
        echo("</td>");
         
        echo("<td>");
        echo($o);
        echo("</td>");
           
        echo("<td>");
        echo($a);
        echo("</td>");
           
        echo("<td>");
        echo($p);
        echo("</td>");
            
        echo("<td>");
        echo($VAT_client);
        echo("</td>");
            
        echo("<td>");
        echo($VAT_vet);
        echo("</td>");
            
        echo("<td>");
        echo($weight);
        echo("</td>");
            
        echo("</tr>\n");
		
		echo("</table>\n");
?>	

		<h3>Change consult details</h3>
        
        <form action="update_consult2.php" method="post">
            <p><input type="hidden" name="name" value="<?php echo $name; ?>"/></p>
            <p><input type="hidden" name="owner_vat" value="<?php echo $VAT_owner; ?>"/></p>
            <p><input type="hidden" name="date" value="<?php echo $date_timestamp; ?>"/></p>
            <p>Subjective Observation:<input type="text" name="s" value="<?php echo $s; ?>"/></p>
            <p>Objective Observation:<input type="text" name="o" value="<?php echo $o; ?>"/></p>
            <p>Assessment:<input type="text" name="a" value="<?php echo $a; ?>"/></p>
            <p>Plan:<input type="text" name="p" value="<?php echo $p; ?>"/></p>
            <p>Veterinary VAT:<input type="text" name="vet_vat" value="<?php echo $VAT_vet; ?>"/></p>
            <p>Weight:<input type="text" name="weight" value="<?php echo $weight; ?>"/></p>
            <input type="submit" value="Register"/>
        </form>
		
		
<?php 	echo("<a href=\"consult_details.php?animal_name=$name&vat_owner=$VAT_owner&consult_date=$date_timestamp\">Back to consult details</a>"); ?>
    </body>
</html>