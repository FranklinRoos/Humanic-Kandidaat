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

if($_SESSION['blad']!=='blogEdit_page')    
{
  $_SESSION['blad']='blogEdit_page';
  $_SESSION['blogEdit_page']=0;
}

//onlineShow();
//onlineTable();

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
    If(!isset($_POST['submit_edit_item']))
    {
    //overzicht artikelen, selectie van een artikel
        If(!isset($_GET['blog_id']))
        {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        overzicht();
        echo "</div>"; 
        }
        else
        {    //bewerk de artikel item met FCKeditor
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        blogBewerken();
        echo "</div>"; 
        }
    //sla de artikel op in de database tabel artikelen
    }
    else 
        {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        blogBewerktOpslaan();
        echo "</div>"; 
    }
    echo "</div>";
    //controleer de wijziging
}

if($_SESSION["user_authorisatie"]=="ptr")
{
        navigatiePtr($pageNavId);
    If(!isset($_POST['submit_edit_item']))
    {
    //overzicht artikelen, selectie van een artikel
        If(!isset($_GET['blog_id']))
        {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        overzicht();
        echo "</div>"; 
        }
        else
        {    //bewerk de artikel item met FCKeditor
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        blogBewerken();
        echo "</div>"; 
        }
    //sla de artikel op in de database tabel artikelen
    }
    else 
        {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        blogBewerktOpslaan();
        echo "</div>"; 
    }
    echo "</div>";
    //controleer de wijziging
} 

fFooter($pageNavId);

?>