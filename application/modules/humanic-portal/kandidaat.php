<?php
//session_start();
// If we know we don't need to change anything in the
// session, we can just read and close rightaway to avoid
// locking the session file and blocking other pages
session_start();
include("../../config/config.php");
include("../../config/connect.php");
include("../../config/default_functions.php");
include("include/humanic-functions.php");
include("include/formValidatie.php");

if(!isSet($_SESSION['loginnaam'])) {
                    echo "<script type=\"text/javascript\">
                                    window.location = \"".$GLOBALS['path']."/application/modules/admin/indexAdmin.php\"
                                     </script>";
}

/*if(!isSet($_SESSION['blad']))
  {
    $_SESSION['blad']='kandidaat_page';
    }    
if(isSet($_SESSION['blad'])&& $_SESSION['blad'] !=='kandidaat_page')    
{
  $_SESSION['blad']='kandidaat_page';
}*/

 $pageNavId=6;
 fHeader($pageNavId);//actief=$pageNavId);

 
 if(!isSet($_SESSION['user_authorisatie']) OR $_SESSION['user_authorisatie']=='usr')
 {
     navigatie($pageNavId);
 }
 
/* elseif(isSet($_SESSION["user_authorisatie"])&& $_SESSION["user_authorisatie"]=="admin" OR $_SESSION["user_authorisatie"]=="ptr")
         {
           navigatieA($pageNavId);
         }*/
 
/*
if (!isset($_SESSION["loginnaam"]))
   {
    echo "<br /><br /><br /><h2 align=center>Dit is de website van en over Pieter Spierenburg</h2>";
    echo "<br /><h3>U dient eerst<a href=\"login.php\"> ingelogd</a> te zijn</h3>";
    
} 
 else   
  
{ */
global $connection;
$functieArray = array();
$sql = mysqli_query($connection, "SELECT * FROM user_functie WHERE `user_id` = '".$_SESSION['user_id']."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $newArray = array($row['functie_id'], $row['ervaring']);
            array_push($functieArray, $newArray);
        }
    }
    else {
        echo "fout";
    };
//vullen sectorArray    
$sectorArray = array();
    $sql = mysqli_query($connection, "SELECT * FROM user_sector WHERE `user_id` = '".$_SESSION['user_id']."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $newArray = array($row['sector_id']);
            array_push($sectorArray, $newArray);
        }
    }
    else {
        echo "fout";
    };
//vullen bedrijf Array    
$bedrijfArray = array();
    $sql = mysqli_query($connection, "SELECT * FROM user_bedrijf WHERE `user_id` = '".$_SESSION['user_id']."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $newArray = array($row['bedrijf_id']);
            array_push($bedrijfArray, $newArray);
        }
    }
    else {
        echo "fout";
    };
// vullen regio array    
$regioArray = array();
    $sql = mysqli_query($connection, "SELECT * FROM user_regio WHERE `user_id` = '".$_SESSION['user_id']."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $newArray = array($row['regio_id']);
            array_push($regioArray, $newArray);
        }
    }
    else {
        echo "fout";
    };

if(!isSet($_POST['submit']))
{
    /* ****Important!****
    replace name@your-web-site.com below 
    with an email address that belongs to 
    the website where the script is uploaded.
    For example, if you are uploading this script to
    www.my-web-site.com, then an email like
    form@my-web-site.com is good.
    */

// vullen functie array
    
    

    showKandidaatRegForm (); // deze functie komt in humanic-portal/include/humanic-functions.php
    
}
 else 
 {
   handleKandidaatRegForm (); // deze functie komt in humanic-portal/include/humanic-functions.php
}
	
//}
fFooter($pageNavId);
?>


     

     