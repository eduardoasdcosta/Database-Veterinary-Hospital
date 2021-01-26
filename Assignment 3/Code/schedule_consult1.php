<html>
    <body>
<?php
		$animal_name = $_REQUEST['animal_name'];
        $client_VAT = $_REQUEST['client_VAT'];
		$owner_VAT = $_REQUEST['owner_VAT'];
?>	
		<h3>Schedule consult</h3>
        
        <form action="schedule_consult2.php" method="post">
            <p>Animal Name:<input type="text" name="animal_name" value="<?php echo $animal_name; ?>"/></p>
            <p>Owner VAT:<input type="text" name="owner_vat" value="<?php echo $owner_VAT; ?>"/></p>
            <p>Client VAT:<input type="text" name="client_vat" value="<?php echo $client_VAT; ?>"/></p>
            <p>Date (yyyy-mm-dd):<input type="text" name="date"/></p>
            <p>Veterinary VAT (optional):<input type="text" name="vet_vat"/></p>
            <input type="submit" value="Register"/>
        </form>	
<?php	echo("<p><a href=\"main.php\">Back to main menu</a></p>");	?>
    </body>
</html>