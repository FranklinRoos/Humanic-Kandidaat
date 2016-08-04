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
navigatieAdmin($pageNavId);
//onlineShow();
//onlineTable();

if($_SESSION['blad']!=='reactEdit_page')    
{
  $_SESSION['blad']='reactEdit_page';
  $_SESSION['reactEdit_page']=0;
}


echo"<div class=\"container\">";

if(!isset($_SESSION['loginnaam']))
{
    echo "<script type=\"text/javascript\">
           window.location = \"".$GLOBALS['path']."/application/modules/admin/indexAdmin.php\"
      </script>";
}
if($_SESSION["user_authorisatie"]=="admin" OR $_SESSION["user_authorisatie"]=="ptr")
{
    If(!isset($_POST['submit_edit_item']))
    {
    //overzicht artikelen, selectie van een artikel
        If(!isset($_GET['reactie_id']))
        {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        reactieOverzicht();
        echo "</div>"; 
        }
        else
        {    //bewerk de artikel item met FCKeditor
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        reactieBewerken();
        echo "</div>"; 
        }
    //sla de artikel op in de database tabel artikelen
    }
    else 
        {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        reactieBewerktOpslaan();
        echo "</div>"; 
    }
    echo "</div>";
    //controleer de wijziging
}  
fFooter($pageNavId);

?>