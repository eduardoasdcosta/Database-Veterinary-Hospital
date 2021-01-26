<html>
    <body>
<?php
		$animal_name = $_REQUEST['animal_name'];
        $client_VAT = $_REQUEST['client_VAT'];
?>	

		<h3>Register new animal</h3>
		
        <p>Animal Name: <?php echo $animal_name; ?></p>
        <p>Owner VAT: <?php echo $client_VAT; ?></p>
        
        <form action="register_animal2.php" method="post">
            <p><input type="hidden" name="name" value="<?php echo $animal_name; ?>"/></p>
            <p><input type="hidden" name="VAT" value="<?php echo $client_VAT; ?>"/></p>
            <p>Species Name:<input type="text" name="species_name"/></p>
            <p>Colour:<input type="text" name="colour"/></p>
            <p>Gender:<input type="text" name="gender"/></p>
            <p>Birth Year:<input type="text" name="birth_year"/></p>
            <input type="submit" value="Register"/>
        </form>		
<?php	echo("<p><a href=\"main.php\">Back to main menu</a></p>");	?>
    </body>
</html>