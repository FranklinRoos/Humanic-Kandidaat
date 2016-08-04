<?php
session_start();       // vanuit de database wordt naar dit script(nav.php) verwezen vanuit de tabel navadmin met navadmin_id=4
include ("../../config/config.php");          
include ("../../config/connect.php");       
include("../../config/default_functions.php");
include ("../FCKeditor/fckeditor.php");
include("navFunction.php"); 
//Met dit script zou je de navigatie van de applicatie kunnen 'slopen', het enige doel van dit script was voor mij te oefenen om mbv FCKeditor
if($_SESSION['blad']!=='nav_page')   // deze (admin) functie te maken.De functie is alleen beschikbaar voor users met 'admin' autorisatie.De functies die in dit  
{                                                    // script gebruikt worden bevinden zich in applicaton/modules/nav/navFunctions.php
  //unset ($_SESSION['blad']);
  $_SESSION['blad']='nav_page';
}


$pageNavId=50;
fHeader($pageNavId);
navigatieAdmin($pageNavId);

echo "<div class=\"container\">";

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
    //overzicht navitems, selectie van een navitem
        If(!isset($_GET['nav_id']))
        {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        overzicht();
        echo "</div>";
        }
        else
        {    //bewerk het navitem
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        navBewerken();
        echo "</div>";
        }
    //sla het navitem op in de database tabel nav
    }
    else 
        {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        navBewerktOpslaan();
        echo "</div>";
    }
    //controleer de wijziging
}
echo "</div>";
footer();
?>
