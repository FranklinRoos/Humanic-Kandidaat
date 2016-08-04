<?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
include("../../config/default_functions.php");
include ("../FCKeditor/fckeditor.php");
include("include/userUpdateFunction.php");

$pageNavId=50;
fHeader($pageNavId);


if(isSet($_SESSION['user_authorisatie']) &&  $_SESSION['user_authorisatie']=='admin'){
    navigatieA($pageNavId);
}
else {
   navigatie($pageNavId); 
}

if(isSet($_SESSION['user-form'])){
$formactiv = $_SESSION['user-form'];
}
echo"<div class=\"container\">";

if(!isSet($_SESSION['loginnaam']))
{
    echo "<script type=\"text/javascript\">
           window.location = \"".$GLOBALS['path']."/application/modules/admin/indexAdmin.php\"
      </script>";
    //redirect($GLOBALS['path']."/application/modules/admin/indexAdmin.php");
}
elseif(isSet($_SESSION['loginnaam'])  && isSet($formactiv) && $formactiv == 'yes' && $_SESSION['user_authorisatie']=='usr' OR $_SESSION['user_authorisatie']=='admin')
{
    If(!isset($_POST['submit_edit_item']))
    {
    //overzicht users, selectie van een user
        If(!isset($_GET['user_id']))
        {
           echo "<div class=\"container\" style=\"margin-top:40px;\">";
          overzicht (); // deze functie zit in humanic-portal/include/userUpdateFunction.php
          echo "</div>";
          footer();
        }
        else
        {    //bewerk het user item met FCKeditor
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        userBewerken(); // deze functie zit in humanic-portal/include/userUpdateFunction.php
        echo "</div>";
        footer();
        }
    //sla de user op in de database users artikelen
    }
    else 
        {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        userBewerktOpslaan(); // deze functie zit in humanic-portal/include/userUpdateFunction.php
        echo "</div>";
        footer();
    }
    echo "</div>";
    //controleer de wijziging
}
elseif(isSet($_SESSION['loginnaam'])  && isSet($formactiv) && $formactiv == 'no' && $_SESSION['user_authorisatie']=='usr') {
      echo "<script type=\"text/javascript\">
               window.location = \"".$GLOBALS['path']."/application/modules/humanic-portal/kandidaat.php\"
            </script>";
}
elseif(isSet($_SESSION['loginnaam']) &&   isSet($formactiv) && $formactiv == 'yes' && $SESSION['user_authorisatie']=='admin') {
      echo "<script type=\"text/javascript\">
               window.location = \"".$GLOBALS['path']."/application/modules/users/user.php\"
            </script>";
}
footer();

?>
