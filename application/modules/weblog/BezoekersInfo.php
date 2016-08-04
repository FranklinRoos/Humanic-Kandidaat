<?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
include("../../config/default_functions.php");
include ("../psinfoportal/include/onlineFunctions.php");

$pageNavId=50;
fHeader($pageNavId);//actief=$pageNavId);

if($_SESSION["user_authorisatie"]=="admin")
         {
           navigatieA($pageNavId);
         }
 else
     {
       navigatie($pageNavId);      
     }
 

   $sql = mysqli_query($connection, "SELECT * FROM `user` where `user_online`='y'");
    if (mysqli_num_rows($sql)==0)   
    {
        die ("Je hebt geen gegevens tot je beschikking");
    }
   /* while ($content = mysqli_fetch_assoc($sql)) 
    {
        $userid = $row['user_id'];
        $_SESSION['user_id'] = $userid;
    }*/


  echo "<br />";
  onlineLog($sTime = 300);
  onlineShow();
  echo "<br />";
  onlineTable();

//echo "</div>";  
 fFooter($pageNavId);       
?>

