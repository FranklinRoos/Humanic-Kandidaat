<?php
session_start(); // in de database wordt naar dit script(indexAdmin.php) verwezen vanuit de nav-tabel met nav_id=8
include ("../../config/config.php");
include ("../../config/connect.php");
include("../../config/default_functions.php");
include("../humanic-portal/include/humanic-functions.php");
//fHeader();
$pageNavId=1;
fHeader($pageNavId);//actief=$pageNavId);
navigatie($pageNavId);

/*if($_SESSION['blad']!=='admin_page')    
{
  //unset ($_SESSION['blad']);
  $_SESSION['blad']='admin_page';
}*/


echo"<div class=\"container\">";
echo "<div class=\"container\" style=\"margin-top:40px;\">";

if(isset($_SESSION['loginnaam']))
  { 
    if( $_SESSION["user_authorisatie"]=='admin')
    {
    navigatieAdmin();
    echo "<br><br><br>";
    echo "<h3>Dag Elmar, je kan hier je informatie honger gaan stillen.</h3>";
   /* echo "<input type =\"button\" onclick=\"inofuitLoggen(0)\" value=\"Uitloggen\" class=\"btn\""
        . " style=\"padding: 2px 20px; margin-top: -2px; border: 1px solid rgba(0, 0, 0, 0.33);\"></button>";*/
    fFooter();
    }
    if($_SESSION["user_authorisatie"]=='usr')
    { 
        echo "<h2>U heeft geen administrator rechten</h2>";
        //navigatie();
        fFooter();                                // ALLE NAVIGATIE FUNCTIES BEVINDEN ZICH IN: application/config/default_functions.php
    }
  }   
 elseif(!isset($_SESSION['loginnaam'])) 
     {
     
     echo "<br /><div class=\"bericht\"><h2 align=center>Dit is de website van HumanIC</h2>";
     echo "<br/><h3>U heeft niet de juiste rechten of bent nog niet ingelogd</h3>";
    //echo "<br /><h3>U dient eerst<a href=\"../humanic-portal/login.php\"> ingelogd</a> te zijn</h3></div>";
    fFooter();
     
    }


echo "</div>";   

footer();

?>
