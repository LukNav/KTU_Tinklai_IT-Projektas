<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
 $_SESSION['filtras'] = "VISOS";
$role=""; 
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 

     echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
        echo "<tr><td>";
        echo "Vartotojo vardas: <b>".$user."</b>     Rolė: <b>".$role."</b> <br>";
        echo "</td></tr><tr><td>";
       if ($_SESSION['user'] != "guest" && ($userlevel != $user_roles["Svecias"])) echo "[<a href=\"useredit.php\">Redaguoti paskyrą</a>] &nbsp;&nbsp;";
            echo "[<a href=\"skaitau.php\">Kambarių sąrašas</a>] &nbsp;&nbsp;";

	if ($userlevel == $user_roles["Administratorius"]){
		echo "[<a href=\"ivedimas.php\">Naujas kambarys</a>] &nbsp;&nbsp;";
	}
        if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
            echo "[<a href=\"admin.php\">Direktoriaus sąsaja</a>] &nbsp;&nbsp;";
            echo "[<a href=\"atsiliepimai.php\">Atsiliepimai</a>] &nbsp;&nbsp;";
        }
        if ($userlevel != $user_roles[ADMIN_LEVEL] && $userlevel != $user_roles["Administratorius"] ) 
            echo "[<a href=\"atsiliepimas.php\">Palikti atsiliepimą</a>] &nbsp;&nbsp;";
        echo "[<a href=\"logout.php\">Atsijungti</a>]";
      echo "</td></tr></table>";
?>       
    
 