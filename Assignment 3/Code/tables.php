<html>
	<body>
        <h3>Select table to show</h3>
        <form action="gettable.php" method="post">
            <select name="table_name">
                <option value="animal">animal</option>
                <option value="assistant">assistant</option>
                <option value="client">client</option>
                <option value="consult">consult</option>
                <option value="consult_diagnosis">consult_diagnosis</option>
                <option value="diagnosis_code">diagnosis_code</option>
                <option value="generalization_species">generalization_species</option>
                <option value="indicator">indicator</option>
                <option value="medical_procedure">medical_procedure</option>
                <option value="medication">medication</option>
                <option value="participation">participation</option>
                <option value="performed">performed</option>
                <option value="person">person</option>
                <option value="phone_number">phone_number</option>
                <option value="prescription">prescription</option>
                <option value="produced_indicator">produced_indicator</option>
                <option value="radiography">radiography</option>
                <option value="species">species</option>
                <option value="test_procedure">test_procedure</option>
                <option value="veterinary">veterinary</option>
            </select>
            <input type="submit" value="Select"/>
        </form>
<?php	echo("<p><a href=\"main.php\">Back to main menu</a></p>");	?>
	</body>
</html>