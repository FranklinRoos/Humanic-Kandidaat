<?php
session_start();        // vanuit de database wordt naar dit script(page.php) verwezen vanuit de tabel navadmin met navadmin_id=6
include ("../../config/config.php");
include ("../../config/connect.php");
include("../../config/default_functions.php");
include ("../FCKeditor/fckeditor.php");
include("pageFunction.php");

if($_SESSION['blad']!=='page_page')    
{
  //unset ($_SESSION['blad']);
  $_SESSION['blad']='page_page';
}


$pageNavId=50;
fHeader($pageNavId);
navigatieAdmin($pageNavId);

echo"<div class=\"container\">";

if(!isset($_SESSION['loginnaam']))
{
    echo "<script type=\"text/javascript\">
           window.location = \"".$GLOBALS['path']."/application/modules/admin/indexAdmin.php\"
      </script>";
}
else
{
    If(!isset($_POST['submit_edit_item']))
    {
    //overzicht pages, selectie van een page
        If(!isset($_GET['page_id']))
        {
            echo "<div class=\"container\" style=\"margin-top:40px;\">";
            overzicht();
            echo "</div>";
        } else
        {    //bewerk het page-item met FCKeditor
            echo "<div class=\"container\" style=\"margin-top:40px;\">";
            pageBewerken();
            echo "</div>";
        }
    //sla de het page-item op in de database tabel pages
    }
    else 
    {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        pageBewerktOpslaan();
        echo "</div>";
    }
    
    //controleer de wijziging
}
echo "</div>";
footer();

?>
