<?php
session_start();   // vanuit de database wordt naar dit script(contactBeheer.php) verwezen vanuit de tabel navadmin met navadmin_id=15
include ("../../config/config.php");
include ("../../config/connect.php");
include ("contactBeheerFunctions.php");
include("../../config/default_functions.php");
include ("../FCKeditor/fckeditor.php");

$pageNavId=50;  
fHeader($pageNavId);            // Alle navigatie functies bevinden zich in: application/config/default_functions.php
navigatie($pageNavId);

if($_SESSION['blad']!=='contact_page')    
{
  $_SESSION['blad']='contact_page';
  $_SESSION['contact_page']=0;
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
}

if($_SESSION["user_authorisatie"]=="ptr")
{
        navigatiePtr($pageNavId);
}
    If(!isset($_POST['submit_view_item']))
    {
    //overzicht users, selectie van een user
        If(!isset($_GET['contact_id']))
        {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        berichtOverzicht(); // deze functie zit in application/modules/contactbeheer/contactBeheerFunctions.php
        echo "</div>"; 
        }
        else
        {    //bewerk het user item met FCKeditor
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        berichtBekijken();
        echo "</div>"; 
        }
    //sla de user op in de database users artikelen
    }
    else 
        {
          berichtOverzicht();
        }
    echo "</div>";
    //controleer de wijziging
    

