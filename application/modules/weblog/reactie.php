<?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
include ("weblogFunction.php");
include("../../config/default_functions.php");

if (isset($_SESSION["loginnaam"]))
{
    if(!isSet($_POST['reactiesubmit']))
    { 
        
       showFormReactie(); 
    }
   else 
     {
      
       handleFormReactie();

     }
    echo "<h2>U moet eerst <a href= \"../psinfoportal/login.php\">ingelogd </a>zijn om te kunnen reageren</h2>";
}