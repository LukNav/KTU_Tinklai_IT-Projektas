<?php 
session_start();//kad useris automatiskai nusistatytu kaip siuntejas
$server="localhost";
$user="stud";
$password="stud";
$dbname="stud";

$lentele="kambariai";


  include("include/nustatymai.php");
  include("include/functions.php");
  $_SESSION['name_login']=$user;


$conn = new mysqli($server, $user, $password, $dbname);
mysqli_set_charset($conn,"utf8");


if($_POST !=null){
	//$kambarioValdytojas = $_SESSION['user']; //kad useris automatiskai nusistatytu kaip kurejas
	$pavadinimas = $_POST['pavadinimas'];
	$tipas = $_POST['tipas'];
	$parosKaina = $_POST['parosKaina'];
	$aprasymas = $_POST['aprasymas'];


      $sql = "INSERT INTO $lentele (pavadinimas, tipas, parosKaina, aprasymas) 
             VALUES ('$pavadinimas','$tipas','$parosKaina','$aprasymas')";
		
      if(!$result = $conn->query($sql)) die("Negaliu irasyti: " . $conn->error);
	{header("Location:skaitau.php");
	 exit;}	
}
?>