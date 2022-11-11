<?php 
session_start();//kad useris automatiskai nusistatytu kaip siuntejas
$server="localhost";
$user="stud";
$password="stud";
$dbname="stud";

$lentele="atsiliepimai";


  include("include/nustatymai.php");
  include("include/functions.php");
  $_SESSION['name_login']=$user;


$conn = new mysqli($server, $user, $password, $dbname);
mysqli_set_charset($conn,"utf8");


if($_POST !=null){
	//$kambarioValdytojas = $_SESSION['user']; //kad useris automatiskai nusistatytu kaip kurejas
	$priezastis = $_POST['priezastis'];
	$zinute = $_POST['zinute'];
	$atsiliepimoData = "NOW()";


      $sql = "INSERT INTO $lentele (priezastis, zinute, atsiliepimoData) 
             VALUES ('$priezastis','$zinute',NOW())";
		
      if(!$result = $conn->query($sql)) die("Negaliu irasyti: " . $conn->error);
	{header("Location:index.php");
	 exit;}	
}
?>