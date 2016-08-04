<?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
include ("weblogFunction.php");
include("../../config/default_functions.php");


$pageNavId=50;
fHeader($pageNavId);//actief=$pageNavId);
navigatie($pageNavId);
// haal de gegevens voor de pagina uit de database
if (isset($_SESSION["loginnaam"]))
{
    if(!isSet($_POST['blogsubmit']))
    { 
       showAddBlogForm(); 
    }
   else 
     {
       handleBlogForm();

     }
   
}

fFooter($pageNavId);
        
