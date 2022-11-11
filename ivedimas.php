<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<script>
			function validateForm() {
			  var x = document.forms["myForm"]["fname"].value;
			  if (x == "" || x == null) {
				alert("Field must be filled in");
				return false;
			  }
			}
			</script>
	</head>

	<form method='post' action='irasau.php' onsubmit="return validateForm()">
     Pavadinimas:<input name='pavadinimas' required="required" pattern="[A-Za-z0-9 ,.]{5,50}"><br><br>
     Tipas: <input name='tipas' required="required" pattern="[1-3]"><br><br>
     Paros Kaina: <input name='parosKaina' required="required" pattern="[0-9]{1,50}"><br><br>
     Aprasymas: <input name='aprasymas' required="required" pattern="[A-Za-z0-9 ,.]{5,200}"><br><br>
    <input type='submit' name='JJJJ' value='Patvirtinti'>
		<!--<?php//Dropdown listui
				include("include/nustatymai.php"); //kad rastų lentelę users
			$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
			$sql = "SELECT username"
            . "FROM " . TBL_USERS;
			$result = mysqli_query($db, $sql);
			if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Klaida skaitant lentelę users"; exit;}
		?>-->
	</form>
</html>