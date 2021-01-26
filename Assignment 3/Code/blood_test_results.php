<html>
    <body>

<?php
        $animal_name = $_REQUEST['animal_name'];
        $owner_VAT = $_REQUEST['vat_owner'];
        $consult_date = $_REQUEST['consult_date'];
?>  
        <h3>Insert test results</h3>
        
       <form action="test_details.php" method="post">
            <p>Assistant VAT:<input type="text" name="assist_VAT"/></p>
            <p>Acidosis Level:<input type="text" name="acidosis" value="0"/></p>
            <p>Cholesterol Level:<input type="text" name="cholesterol" value="0"/></p>
            <p>Creatinine Level:<input type="text" name="creatinine" value="0"/></p>
            <p>Glucose Level:<input type="text" name="glucose" value="0"/></p>
            <input type="submit" value="Add test results"/>

            <!-- Export also animal_name, owner_VAT and consult date -->
            <input type="hidden" name="animal_name" value="<?php echo $animal_name;?>">
            <input type="hidden" name="owner_VAT" value="<?php echo $owner_VAT;?>">
            <input type="hidden" name="consult_date" value="<?php echo $consult_date;?>">
            
        </form>
		
		
        <?php echo("<p><a href=\"consult_list.php?animal_name=$animal_name&vat_owner=$owner_VAT\">Back to consult list</a></p>"); ?>

    </body>
</html>