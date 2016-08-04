<?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
include("include/onlineFunctions.php");
include ("include/userBlogFunctions.php");
include("../../config/default_functions.php");

 $pageNavId=13;
 fHeader($pageNavId);//actief=$pageNavId);
 
 if($_SESSION['blad']!=='blog_page')    
{
  $_SESSION['blad']='blog_page';
  $_SESSION['blog_page']=0;
}


if(isSet($_SESSION["user_authorisatie"])&& $_SESSION["user_authorisatie"]=="admin" OR $_SESSION["user_authorisatie"]=="ptr")
         {
           navigatieA($pageNavId);
         }
 else
     {
       navigatie($pageNavId);      
     }
 


if (isset($_SESSION["loginnaam"]))
{

      if(!isSet($_POST['reactiesubmit']))
       { 
         showFormReactie($_GET['blog_id']);
       }
      else
       {
         handleFormReactie($_SESSION['blog_id'],$_SESSION["loginnaam"]);  
       }
}
 else 
     {
    
    //echo "<h2>U moet eerst <a href= \"../psinfoportal/login.php\">ingelogd </a>zijn om te kunnen reageren!!</h2>";
     
    echo "<br /><br /><br /><h2 align=center>Dit is de website van en over Pieter Spierenburg</h2>";
    echo "<br /><h3>U dient eerst<a href=\"login.php\"> ingelogd</a> te zijn om een reactie te kunnen plaatsen</h3><br>";
    echo "<h4>Heeft u zich nog niet geregistreerd?<br/>";
    echo "Dat kan <a href=\"register.php\">hier.</a></h4>";
     

      }
fFooter($pageNavId);
