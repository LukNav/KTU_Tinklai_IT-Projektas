<?php
//nustatymai.php
define("DB_SERVER", "localhost");
define("DB_USER", "stud");
define("DB_PASS", "stud");
define("DB_NAME", "stud");
define("TBL_USERS", "users");
$user_roles=array(
	"Direktorius"=>"9",
	"Administratorius"=>"5", 
	"Prisiregistraves"=>"4",
	"Svecias"=>"3"); 

$rooms=array(
	"vienvietis"=>"1",
	"dvivietis"=>"2", 
	"trivietis"=>"3"); 
	define("VienvietisKambarys","vienvietis");
	define("DvivietisKambarys","dvivietis");
	define("TrivietisKambarys","trivietis");

define("DEFAULT_LEVEL","Prisiregistraves");  // kokia rolė priskiriama kai registruojasi
define("ADMIN_LEVEL","Direktorius");  // kas turi vartotojų valdymo teisę
define("UZBLOKUOTAS","255");      // vartotojas negali prisijungti kol administratorius nepakeis rolės
$uregister="both";  // kaip registruojami vartotojai
// self - pats registruojasi, admin - tik ADMIN_LEVEL, both - abu atvejai
// * Email Constants - 
define("EMAIL_FROM_NAME", "Demo");
define("EMAIL_FROM_ADDR", "demo@ktu.lt");
define("EMAIL_WELCOME", false);
