<html>
    <body>
<?php	
		$animal_name = $_REQUEST['animal_name']; 
		$client_VAT = $_REQUEST['VAT']; 
?>

        <h3>Find an animal</h3>
        
        <form action="access_animal.php" method="post">
            <p>Animal Name:<input type="text" name="animal_name" value="<?php echo $animal_name; ?>"/><p>
            <p>Client VAT:<input type="text" name="client_VAT" value="<?php echo $client_VAT; ?>"/></p>
            <p>Owner Name:<input type="text" name="owner_name"/></p>
            <input type="submit" value="Access"/>
        </form>
<?php	echo("<p><a href=\"main.php\">Back to main menu</a></p>");	?>
    </body>
</html>