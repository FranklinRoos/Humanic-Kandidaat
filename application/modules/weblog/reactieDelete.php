<?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
include ("../weblog/weblogFunction.php");
include("../../config/default_functions.php");
include ("../FCKeditor/fckeditor.php");
include ("../psinfoportal/include/onlineFunctions.php");

$pageNavId=50;
fHeader($pageNavId);

if($_SESSION['blad']!=='reactDelete_page')    
{
  $_SESSION['blad']='reactDelete_page';
  $_SESSION['reactDelete_page']=0;
}


echo"<div class=\"container\">";

if(!isset($_SESSION['loginnaam']))
{
    echo "<script type=\"text/javascript\">
           window.location = \"".$GLOBALS['path']."/application/modules/admin/indexAdmin.php\"
      </script>";
    //redirect($GLOBALS['path']."/application/modules/admin/indexAdmin.php");
}
if($_SESSION["user_authorisatie"]=="admin")
{
      navigatieAdmin($pageNavId);
          If(!isset($_GET['blog_id']))
           {
             echo "<div class=\"container\" style=\"margin-top:40px;\">";
               overzichtReactieDelete();//overzicht van de blogs,selectie te verwijderen blog
              echo "</div>";
           }
         else
           {  //verwijder de blog uit de database
           echo "<div class=\"container\" style=\"margin-top:40px;\">";
           reactieDelete();
          echo "</div>"; 
          $_GET['blog_id']="";
         //Bevestig de verwijdering
           confirmReactieDelete();
          }

}

if($_SESSION["user_authorisatie"]=="ptr")
{
      navigatiePtr($pageNavId);
          If(!isset($_GET['blog_id']))
           {
             echo "<div class=\"container\" style=\"margin-top:40px;\">";
               overzichtReactieDelete();//overzicht van de blogs,selectie te verwijderen blog
              echo "</div>";
           }
         else
           {  //verwijder de blog uit de database
           echo "<div class=\"container\" style=\"margin-top:40px;\">";
           reactieDelete();
          echo "</div>"; 
          $_GET['blog_id']="";
         //Bevestig de verwijdering
           confirmReactieDelete();
          }

}

fFooter($pageNavId);
