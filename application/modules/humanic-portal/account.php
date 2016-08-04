<?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
include("include/accountFunctions.php");
include("include/psinfofunctions.php");
include ("include/userBlogFunctions.php");
include ("include/onlineFunctions.php");
include("../../config/default_functions.php");
include ("../FCKeditor/fckeditor.php");
//maak connectie met je eigen database

if($_SESSION['blad']!=='account_page')    
{
  $_SESSION['blad']='account_page';
}


 $pageNavId=22;
 fHeader($pageNavId);//actief=$pageNavId);

 if(isSet($_SESSION["user_authorisatie"])&& $_SESSION["user_authorisatie"]=="admin" OR $_SESSION["user_authorisatie"]=="ptr")
         {
            navigatieA($pageNavId);
         }
 else
     {
       navigatie($pageNavId);

     }
  
if (!isset($_SESSION["loginnaam"]))
   {
    /*echo "<br /><br /><br /><h2 align=center>Dit is de website van en over Pieter Spierenburg</h2>";
    echo "<br /><h3>U dient eerst<a href=\"login.php\"> ingelogd</a> te zijn om deze functie te kunnen gebruiken</h3><br>";
    echo "<h4>Heeft u zich nog niet geregistreerd?<br/>";
    echo "Dat kan <a href=\"register.php\">hier.</a></h4>";*/
    
             echo "<script type=\"text/javascript\">
                           window.location = \"".$GLOBALS['path']."/index.php\"
                           </script>";    
              
    
    
} 
 else   
  
{
     
     if(!isSet($_POST['modsubmit']))
       {
         showFormModifyAccount($_SESSION["loginnaam"],$_SESSION['email']);  
       }
       else
       {
         handleModifyAccount ();
         echo "".ucfirst($_SESSION["loginnaam"]).",je wachtwoord is gewijzigd<br>";    
         echo "Je zal opnieuw moeten inloggen om verder te gaan !";
    
            // Unset all of the session variables.
             $_SESSION = array();
             session_destroy();
            
         }
          
     
}
fFooter($pageNavId);   