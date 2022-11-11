<?php 
session_start();
$server="localhost";
$user="stud";
$password="stud";
$dbname="stud";
$table="kambariai";

$conn =	new	mysqli($server,	$user, $password, $dbname);
$userr=$_SESSION['user'];

$userlevel=$_SESSION['ulevel'];

$role=""; 
include("include/nustatymai.php");

mysqli_set_charset($conn,"utf8");//	dėl	lietuviškų raidžių
$_SESSION['prev']="skaitau";


   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);

echo "Prisijungęs vartotojas: <b>".$userr."</b><br>";
//rodymas lentelės pagal userius
if ($_SESSION['filtras'] ==	"VISOS") 
	   $sql =	"SELECT * FROM $table";
else if	($_SESSION['filtras'] == "MANO") {
		$Vartotojas = $_SESSION['user'];	
		$sql =  "SELECT * FROM $table	WHERE uzsakovoVardas =	'$Vartotojas'";}
else die ("Bloga filtro	reikšmė:".$_SESSION['filtras']);

//$sql =  "SELECT *	FROM $table";
if (!$result = $conn->query($sql)) die("Negaliu	nuskaityti:	" .	$conn->error);

//Statistics --------------------------------

if(($userlevel == $user_roles[ADMIN_LEVEL]))
{
	$countResult=$conn->query("SELECT Count(0) FROM `kambariai` WHERE arUzsakytas='1'");
	$rowCount = mysqli_fetch_array($countResult);
		$count = $rowCount[0];
	$countResult=$conn->query("SELECT Count(0) FROM `kambariai` WHERE arUzsakytas='0'");
	$rowCount = mysqli_fetch_array($countResult);
		$unreservedCount = $rowCount[0];
	$result = mysqli_query($conn, "SELECT Count(uzsakovoVardas) AS count, uzsakovoVardas FROM kambariai WHERE arUzsakytas = 1 GROUP BY uzsakovoVardas ORDER BY Count(uzsakovoVardas) desc LIMIT 3");
		$row = $result->fetch_assoc();
	$resultTier = mysqli_query($conn, "SELECT Count(tipas) AS tipasCount, tipas FROM kambariai WHERE arUzsakytas = 1 GROUP BY tipas ORDER BY Count(tipas) desc LIMIT 3");
		$popularTiersRow = $resultTier->fetch_assoc();

	

	echo "<ul>
				<li>Užrezervuotų kambarių kiekis: ".$count."</li>
				<li>Neužrezervuotų kambarių kiekis: ".$unreservedCount."</li>
				<li>Populiariausio tipo kambariai: </li>
					<ul>
						<li>"; 
						if($popularTiersRow)
						{
							echo "
								<table border=\"1\">
									<table style=\"margin: 0px;\" id=\"kambariai\" border=\"1\">
										<tr>
											<th>Populiariausias kambario tipas</th>
											<th>Rezervuotų kambarių kiekis</th>
										</tr>
										<tr>
										<td>";
										switch($popularTiersRow['tipas']){
											case 1:
												echo "Vienvietis kambarys"; break;
											case 2:
												echo "Dvivietis kambarys"; break;
											case 3:
												echo "Trivietis kambarys"; break;
											}
										echo "</td> 
											<td>".(int)$popularTiersRow['tipasCount']."</td>
										</tr>";
										while($popularTiersRow = $resultTier->fetch_assoc())
										{
										echo"<tr>
											<td>".$popularTiersRow['tipas']."</td> 
											<td>".$popularTiersRow['tipasCount']."</td>
										</tr>";
										}
										
							echo"		</table>
								</table>";
					
						}
						else
							echo "<h2> Kolkas rezervacijų nėra </h2>";
	echo "				</li>
					</ul>
				<li>Aktyviausi klientai: </li>
				<ul><li>";
	if($row)
	{
		echo "
			<table border=\"1\">
				<table id=\"kambariai\" border=\"1\">
					<tr>
						<th>Pelningiausi klientai</th>
						<th>Aktyvių rezervacijų kiekis</th>
					</tr>
					<tr>
						<td>".$row['uzsakovoVardas']."</td> 
						<td>".(int)$row['count']."</td>
					</tr>";
					while($row = $result->fetch_assoc())
					{
					echo"<tr>
						<td>".$row['uzsakovoVardas']."</td> 
						<td>".$row['count']."</td>
					</tr>";
					}
					
		echo"		</table>
			</table>";

	}
	else
		echo "<h2> Kolkas rezervacijų nėra </h2>";
				echo"</li></ul>
		</ul>";


}
//List of all items ----------------------------
echo "<table border=\"1\">";

echo "<form name=\"Visi kambariai\" action=\"procskaitaudb.php\" method=\"post\">";

$sql = "SELECT * FROM $table";
    $result = mysqli_query($conn, $sql);
	echo "<table style=\"margin: 0px auto;\" id=\"kambariai\" border=\"1\">";
	echo "<tr>";
	if (($userlevel == $user_roles["Administratorius"]) || ($userlevel == $user_roles[ADMIN_LEVEL] ))
		echo "<th>Id</th>";
	
	echo "<th>Pavadinimas</th>
	<th>Tipas</th>
	<th>Paros Kaina (Eur)</th>
	<th>Aprašymas</th>";
	
	if (($userlevel == $user_roles["Administratorius"]) || ($userlevel == $user_roles[ADMIN_LEVEL] )){
	echo "<th>Užsakytas</th>
		<th>Užsakovo vardas</th>
		<th>Valdyti rezervaciją</th>
		<th>Redaguoti aprašą</th>
		<th>Šalinti?</th>";
	}
	else if(($userlevel != $user_roles["Svecias"]))
		echo "<th>Rezervuoti</th>";

	echo "</tr>";

while($row = $result->fetch_assoc()) {
	$id= $row['id'];
	$_SESSION['idKambario'] = $id;
	if($row['arUzsakytas'] == 1 && ($user_roles["Prisiregistraves"] == $userlevel || $user_roles["Svecias"] == $userlevel) && $row['uzsakovoVardas'] != $userr)
		continue;
	echo "<tr>";
	if (($userlevel == $user_roles["Administratorius"]) || $userlevel == $user_roles[ADMIN_LEVEL] )
		echo	
			"<td>".$row['id']."</td>";

	echo"<td>".$row['pavadinimas']."</td>
		<td>";
		switch($row['tipas']){
			case 1:
				echo "Vienvietis kambarys"; break;
			case 2:
				echo "Dvivietis kambarys"; break;
			case 3:
				echo "Trivietis kambarys"; break;
			}
		echo "</td>
		<td>".$row['parosKaina']."</td>
		<td>".$row['aprasymas']."</td>";
		if($row['arUzsakytas'] == 1 && (($userlevel == $user_roles["Administratorius"]) || $userlevel == $user_roles[ADMIN_LEVEL])) 
				echo "<td>Užsakytas</td>
					  <td>".$row['uzsakovoVardas']."</td>
					  <td><button type=\"submit\" name=\"azym".$id."\" value=\"Tea\">Išregistruoti</button></td>";
				
		else if(($userlevel == $user_roles["Administratorius"]) || $userlevel == $user_roles[ADMIN_LEVEL])
			echo "<td>Neužsakytas</td>
			<td>-</td>
			<td><button type=\"submit\" name=\"pazymAdministracija".$id."\" value=\"Tea\">Užrezervuoti</button></td>";
		else if($row['arUzsakytas'] == 0 && ($userlevel != $user_roles["Svecias"]))
			echo "<td><button type=\"submit\" name=\"pazym".$id."\" value=\"Tea\">Rezervuoti</button></td>";
		else if($userlevel != $user_roles["Svecias"])
			echo "<td><button type=\"submit\" name=\"azym".$id."\" value=\"Tea\">Atšaukti savo rezervaciją</button></td>";
		if (($userlevel == $user_roles["Administratorius"]) || $userlevel == $user_roles[ADMIN_LEVEL] )
			echo 
				"<td><button type=\"submit\" name=\"edit".$id."\" value=\"Tea\">Redaguoti</button></td>
				<td><button type=\"submit\" name=\"salinti".$id."\" value=\"Tea\">Šalinti</button></td>";
	echo 
	"</tr>";
		
}

$countResult=$conn->query("SELECT Count(0) FROM `kambariai` WHERE arUzsakytas='1'");
	$rowCount = mysqli_fetch_array($countResult);
		$count = $rowCount[0];
if(($userlevel == $user_roles["Administratorius"]))
	echo "<tr><td colSpan='5'> Užsakytų kambarių: ".$count." </td></tr>";
echo"</table>";
echo "<a href=\"index.php\"><b> Grįžti į meniu <b></a>";
?>