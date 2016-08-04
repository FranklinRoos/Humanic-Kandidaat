<?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
include("../../config/default_functions.php");
include ("../FCKeditor/fckeditor.php");
include("userFunction.php");

$pageNavId=50;
fHeader($pageNavId);
navigatieAdmin($pageNavId);

if($_SESSION['blad']!=='user_page')    
{
  $_SESSION['blad']='user_page';
  $_SESSION['user_page']=0;
}


echo"<div class=\"container\">";

if(!isset($_SESSION['loginnaam']))
{
    echo "<script type=\"text/javascript\">
           window.location = \"".$GLOBALS['path']."/application/modules/admin/indexAdmin.php\"
      </script>";
    //redirect($GLOBALS['path']."/application/modules/admin/indexAdmin.php");
}
else
{
    If(!isset($_POST['submit_edit_item']))
    {
    //overzicht users, selectie van een user
        If(!isset($_GET['user_id']))
        {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        overzicht();
        echo "</div>"; 
        }
        else
        {    //bewerk het user item met FCKeditor
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        userBewerken();
        echo "</div>"; 
        }
    //sla de user op in de database users artikelen
    }
    else 
        {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        userBewerktOpslaan();
        echo "</div>"; 
    }
    echo "</div>";
    //controleer de wijziging
}  
footer();

?>
