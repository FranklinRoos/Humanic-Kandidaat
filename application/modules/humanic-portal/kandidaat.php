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

$pageNavId=6;

if(!isSet($_SESSION['loginnaam']) OR $_SESSION['user_authorisatie']=='usr') {
                    echo "<script type=\"text/javascript\">
                                    window.location = \"".$GLOBALS['path']."/application/modules/admin/indexAdmin.php\"
                                     </script>";
}

 fHeader($pageNavId);
navigatie();

if(!isSet($_SESSION['blad']))
  {
    $_SESSION['blad']='kandidaat_blad';
    }    
if(isSet($_SESSION['blad'])&& $_SESSION['blad'] !=='kandidaat_blad')    
{
  $_SESSION['blad']='kandidaat_blad';
}

    
    if (isSet($_GET['user_id']))
        {
            $_SESSION['kandidaat_id'] = $_GET['user_id'];
            $knd_id = $_SESSION['kandidaat_id'];//echo "kandidaat-id= '".$knd_id."'";
        }
    if(isSet ($_SESSION['kandidaat_id']) && !isSet($_GET['user_id']))
        {
            $_GET['user_id'] = $_SESSION['kandidaat_id'];
            $knd_id = $_GET['user_id'];
        } 
        
        maakSessieVariabelen();    

/*$sql = mysqli_query($connection, "SELECT * FROM user `user_id` = '".$knd_id."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $_SESSION['kandidaatLogin'] =  $row['user_inlognaam'];
        }
    }
    else {
        echo "fout";
    };*/

$functieArray = array();
$sql = mysqli_query($connection, "SELECT * FROM user_functie WHERE `user_id` = '".$knd_id."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $newArray = array($row['functie_id'], $row['ervaring']);
            array_push($functieArray, $newArray);
        }
    }
    else {
        echo "fout";
    };
    
     
$gewensteSectorArray = array();   
    $sql = mysqli_query($connection, "SELECT * FROM gewenste_sector WHERE `user_id` = '".$knd_id."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $newArray = array($row['sector_id']);
            array_push($gewensteSectorArray, $newArray);
        }
    }
    else {
        echo "fout";
    };    
     
    
//vullen sectorArray    
$sectorArray = array();
    $sql = mysqli_query($connection, "SELECT * FROM user_sector WHERE `user_id` = '".$knd_id."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $newArray = array($row['sector_id'], $row['jaren']);
            array_push($sectorArray, $newArray);
        }
    }
    else {
        echo "fout";
    };
       
//vullen bedrijfGewerkt Array
$bedrijfGewerktArray = array();
$sql = mysqli_query($connection, "SELECT * FROM bedrijfgewerkt WHERE `user_id` = '".$knd_id."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $newArray = array($row['bedrijf_id']);
            array_push($bedrijfGewerktArray, $newArray);
        }
    }
    else {
        echo "fout";
    };      
    
//vullen bedrijf Array    
$bedrijfArray = array();
    $sql = mysqli_query($connection, "SELECT * FROM user_bedrijf WHERE `user_id` = '".$knd_id."'");
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
    $sql = mysqli_query($connection, "SELECT * FROM user_regio WHERE `user_id` = '".$knd_id."'");
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


     

     