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

 $pageNavId=23;
 fHeader($pageNavId);//actief=$pageNavId);
 
 if($_SESSION['blad']!=='terminate_page')    
{
  $_SESSION['blad']='terminate_page';
}


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
    echo "<br /><h3>U dient eerst<a href=\"login.php\"> ingelogd</a> te zijn</h3>"; */
    
    echo "<script type=\"text/javascript\">
                           window.location = \"".$GLOBALS['path']."/index.php\"
                           </script>";    
              
    
    
} 
 else 
 {
     if(!isSet($_POST['termsubmit']))  
        {
         showFormTerminate();
        }
     else
       {  
 
        handleFormTerminate();
        
        echo "<input type =\"button\" id=\"login\" onclick=\"inofuitLoggen(1)\" value=\"Inloggen\" class=\"btn\"></button></div>";
        
         echo "Uw account is succesvol verwijderd,hopelijk komt u heel gauw terug!";

         }

        
}
fFooter($pageNavId); 