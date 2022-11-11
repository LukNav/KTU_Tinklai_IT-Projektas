<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>

	<form method='post' action='atsiliepiu.php'>
    <h3>Anoniminio atsiliepimo forma</h3>
     Priežastis:<input name='priezastis' required="required" pattern="[A-Za-z0-9 ,.]{5,50}"><br><br>
     Žinutė: <textarea name='zinute' rows="4" cols="50" required="required" pattern="[A-Za-z0-9 ,.]{5,50}"></textarea><br><br>
    <input type='submit' name='JJJJ' value='Siųsti'>
		
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