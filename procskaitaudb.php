<?php
// procadmindb.php   admino nurodytus pakeitimus padaro DB
// $_SESSION['ka_keisti'] kuriuos vartotojus, $_SESSION['pakeitimai'] į kokį userlevel
	
session_start();
$server="localhost";
$user="stud";
$password="stud";
$dbname="stud";
$table="kambariai";

// cia sesijos kontrole: tik is procadmin
//if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "procadmin"))
//{ header("Location: logout.php");exit;}

include("include/nustatymai.php");
include("include/functions.php");
$_SESSION['prev'] = "procskaitaudb";
$sql = "SELECT * FROM $table";
$db=mysqli_connect($server, $user, $password, $dbname);
mysqli_set_charset($db,"utf8");

$result = mysqli_query($db, $sql);
$userlevel=$_SESSION['ulevel'];
$id=$_SESSION['idKambario'];
while($row = $result->fetch_assoc()) {
	$id= $row['id'];
	$pazymAdmin=(isset($_POST["pazymAdministracija".$id]));
	$pazym=(isset($_POST["pazym".$id]));
	$azym=(isset($_POST["azym".$id]));
	$salinti=(isset($_POST["salinti".$id]));
	$edit=(isset($_POST["edit".$id]));
	if($pazym)
	{
    	$sql = "UPDATE ".$table." SET arUzsakytas='1', uzsakovoVardas='".$_SESSION['user']."' WHERE id='".$id."'";
				         if (!mysqli_query($db, $sql)) {
                   echo " DB klaida pažymint: " . $sql . "<br>" . mysqli_error($db);
		               exit;}
    header("Location:skaitau.php");exit;
	}
	if($pazymAdmin)
	{
    	$sql = "UPDATE ".$table." SET arUzsakytas='1', uzsakovoVardas='Administracija' WHERE id='".$id."'";
				         if (!mysqli_query($db, $sql)) {
                   echo " DB klaida pažymint: " . $sql . "<br>" . mysqli_error($db);
		               exit;}
    header("Location:skaitau.php");exit;
	}
  
  if($azym)
	{
    	$sql = "UPDATE ".$table." SET arUzsakytas='0', uzsakovoVardas=NULL WHERE id='".$id."'";
				         if (!mysqli_query($db, $sql)) {
                   echo " DB klaida pažymint: " . $sql . "<br>" . mysqli_error($db);
		               exit;}
    header("Location:skaitau.php");exit;
	}
  
	if($salinti)
	{
   			$sql = "DELETE FROM ". $table. "  WHERE id='".$id."'";
				         if (!mysqli_query($db, $sql)) {
                   echo " DB klaida šalinant kambarį: " . $sql . "<br>" . mysqli_error($db);
		               exit;}
    header("Location:skaitau.php");exit;
	}
  if($edit)
	{
    echo "<center><h2>Kambario informacijos redagavimas<h2>";
    echo "<form method='post' action=''>";
    $sql = "SELECT * FROM $table WHERE id = '$id'";
    $result = mysqli_query($db, $sql);
	echo "<table style=\"margin: 0px auto;\" id=\"kambariai\" border=\"1\">";
	echo "<tr>
	<th>Id</th>
	<th>Pavadinimas</th>
	<th>Tipas</th>
	<th>Paros Kaina (Eur)</th>
	<th>Aprašymas</th>
  <th>Patvirtinti Pakeitimus</th>";
		
	echo "</tr>";
		while($row = $result->fetch_assoc()) {
	$id= $row['id'];
	$_SESSION['idKambario'] = $id;
	echo "<tr style='background:khaki'>
		<td>".$row['id']."</td>
    <td><input class =\"s1\" name=\"Pavadinimas\" required=\"required\" pattern=\"[A-Za-z0-9 ,.]{5,50}\" style='width:80px;' value=\"". $row['pavadinimas'] . "\"></td>
    <td><input class =\"s1\" name=\"Tipas\"  required=\"required\" pattern=\"[1-3]\" style='width:80px;' value=\"" . $row['tipas'] . "\"></td>
    <td><input class =\"s1\" name=\"ParosKaina\" style='width:80px;'required=\"required\" pattern=\"[0-9]{1,50}\" value=\"" . $row['parosKaina'] . "\"></td>
    <td><input class =\"s1\" name=\"Aprašymas\" style='width:80px;'required=\"required\" pattern=\"[A-Za-z0-9 ,.]{5,200}\" value=\"" . $row['aprasymas'] . "\"></td>
    <td><button type=\"submit\" name=\"tvirtinti\" style='width:80px;' value=\"Tea\" >Patvirtinti</button></td>";
    
	}
	
	echo "</tr>";
	
echo "</table>";
echo "<a href=\"index.php\"><b> Grįžti į meniu <b></a>";
  }
}
$postedEdit=(isset($_POST["tvirtinti"]));
if($postedEdit)
{
  $id = $_SESSION['idKambario'];
  $pavadinimas = $_POST["Pavadinimas"];  
  $tipas = $_POST["Tipas"];
  $parosKaina = $_POST["ParosKaina"];
  $aprasymas = $_POST["Aprašymas"];
  $sql = "UPDATE kambariai SET 
id='$id',
pavadinimas='$pavadinimas',
tipas='$tipas',
parosKaina='$parosKaina',
aprasymas='$aprasymas'
          WHERE  id='$id'";
				         if (!mysqli_query($db, $sql)) {
                   echo " DB klaida redaguojant kambarį: " . $sql . "<br>" . mysqli_error($db);
		               exit;}
	
  header("Location:skaitau.php");exit;

}

//header("Location:skaitau.php");exit;