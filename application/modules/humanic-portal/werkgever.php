<?php
session_start();
include("../../config/config.php");
include("../../config/connect.php");
include("../../config/default_functions.php");
include("include/humanic-functions.php");
include("include/formValidatie.php");

if(!isSet($_SESSION['blad']))
  {
    $_SESSION['blad']='kandidaat_page';
    }    
if(isSet($_SESSION['blad'])&& $_SESSION['blad'] !=='kandidaat_page')    
{
  $_SESSION['blad']='kandidaat_page';
}

 $pageNavId=3;
 fHeader($pageNavId);//actief=$pageNavId);
 
 if(!isSet($_SESSION['user_authorisatie']) OR $_SESSION['user_authorisatie']=='usr')
 {
     navigatie($pageNavId);
 }
 
 elseif(isSet($_SESSION["user_authorisatie"])&& $_SESSION["user_authorisatie"]=="admin" OR $_SESSION["user_authorisatie"]=="ptr")
         {
           navigatieA($pageNavId);
         }
 
/*
if (!isset($_SESSION["loginnaam"]))
   {
    echo "<br /><br /><br /><h2 align=center>Dit is de website van en over Pieter Spierenburg</h2>";
    echo "<br /><h3>U dient eerst<a href=\"login.php\"> ingelogd</a> te zijn</h3>";
    
} 
 else   
  
{ */


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
    showWergeverForm (); // deze functie komt in humanic-portal/include/humanic-functions.php
    
}
 else 
 {
   handleWerkgeverForm (); // deze functie komt in humanic-portal/include/humanic-functions.php
}
	
//}
fFooter($pageNavId);
?>


     

     