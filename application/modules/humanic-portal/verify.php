<?php
session_start();
include("../../config/config.php");
include("../../config/connect.php");
include("../../config/default_functions.php");
include("include/humanic-functions.php");
include("include/onlineFunctions.php");

$pageNavId=1;
fHeader($pageNavId);//actief=$pageNavId);
echo "<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Activerings-email</title>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    </head>
    <body>";
        
            
     //<?php 

     echo "<h1>Registratie status</h1>";
       $sql = mysqli_query($connection, "SELECT * FROM `user` WHERE `user_activ`='no'");
        if (mysqli_num_rows($sql)==0)  
        {
            die ("Je heb geen gegevens tot je beschikking");
        }
        while ($row = mysqli_fetch_assoc($sql)) 
         {           
            if(isSet($row['activ_code'])&& $_GET['acode'] == $row['activ_code'])
                 {
                     date_default_timezone_set("Europe/Amsterdam");
                     $email=$row['user_email'];
                     $laatsgezien = date("y-m-d");
                     $laatsgezienTijdstip = date("H:i:s");
                     $code = $row['activ_code'];
                     $code = "";
                     $user = $row['user_id'];
                     //print_r($_GET['acode']);
                     $sql2 = mysqli_query($connection, "UPDATE `user` SET `user_activ`='yes' ,
                     `activ_code`='".$code."', `datum_gezien`='".$laatsgezien."',
                     `tijdstip_gezien`='".$laatsgezienTijdstip."', `user_sinds`= '".$laatsgezien."' WHERE `user_id`=$user");
                     
                     
                             echo "Uw account is nu actief<br>";
                             echo "U kunt nu <a href=\"kandidaat.php\"> het kandidaat formulier </a> invullen<br>";
                       //  }
                 }
                  
         }
  
    echo "</body>";
echo "</html>";
fFooter();
?>
