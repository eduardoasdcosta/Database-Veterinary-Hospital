<html>
    <body>
<?php	$client_VAT = $_REQUEST['client_VAT']; ?>
		<h3>Register new client</h3>
        
        <form action="register_client2.php" method="post">
            <p>Client VAT:<input type="text" name="client_VAT" value="<?php echo $client_VAT; ?>"/></p>
            <p>Client Name:<input type="text" name="client_name"/></p>
            <p>Street:<input type="text" name="address_street"/></p>
            <p>City:<input type="text" name="address_city"/></p>
            <p>ZIP Code:<input type="text" name="address_zip"/></p>
            <input type="submit" value="Register"/>
        </form>	
<?php	echo("<p><a href=\"main.php\">Back to main menu</a></p>");	?>
    </body>
</html>