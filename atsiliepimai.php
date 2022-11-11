<?php 
session_start();
$server="localhost";
$user="stud";
$password="stud";
$dbname="stud";
$table="atsiliepimai";

$conn =	new	mysqli($server,	$user, $password, $dbname);
$userr=$_SESSION['user'];

$userlevel=$_SESSION['ulevel'];

$role=""; 
include("include/nustatymai.php");

mysqli_set_charset($conn,"utf8");//	dėl	lietuviškų raidžių
$_SESSION['prev']="skaitau";

if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);

if(($userlevel == $user_roles[ADMIN_LEVEL]))
{
	
	$result = mysqli_query($conn, "SELECT * FROM atsiliepimai");
		$row = $result->fetch_assoc();
		if($row){
				echo "<table style=\"margin: 0px auto;\" id=\"kambariai\" border=\"1\">";
				echo "<tr>";
				echo "<th>Priežastis</th>
				<th>Žinutė</th>
				<th>Atsiliepimo data</th></tr>";
				echo"<tr><td>".$row['priezastis']."</td>
					<td>".$row['zinute']."</td>
					<td>".date("Y-m-d G:i", strtotime($row['atsiliepimoData']))."</td></tr>";
			while($row = $result->fetch_assoc()) {
				echo"<td>".$row['priezastis']."</td>
					<td>".$row['zinute']."</td>
					<td>".date("Y-m-d G:i", strtotime($row['atsiliepimoData']))."</td>";
				echo 
				"</tr>";
					
			}

			$countResult=$conn->query("SELECT Count(0) FROM `atsiliepimai`");
				$rowCount = mysqli_fetch_array($countResult);
					$count = $rowCount[0];

			echo "<tr><td colSpan='2'> Atsiliepimų kiekis: ".$count." </td></tr>";
			echo"</table>";
		}
		else{
			echo "<h3>Atsiliepimų nėra</h3>";
		}
}
echo "<a href=\"index.php\"><b> Grįžti į meniu <b></a>";
?>