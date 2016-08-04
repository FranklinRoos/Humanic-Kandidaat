<?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
include("../../config/default_functions.php");
include ("../FCKeditor/fckeditor.php");
include("weblogFunction.php");




$pageNavId=50;
fHeader($pageNavId);
navigatie($pageNavId);

if($_SESSION['blad']!=='blogAdd_page')    
{
  $_SESSION['blad']='blogAdd_page';
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
    If(!isset($_POST['submit_add_blog']))
    {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        blogAddShowForm();
        echo "</div>";
    }
    else
        
    {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
       
        blogAddOpslaan();
        echo "</div>";
    }
    
}
if($_SESSION["user_authorisatie"]=="ptr")
{
        navigatiePtr($pageNavId);
     If(!isset($_POST['submit_add_blog']))
    {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
        blogAddShowForm();
        echo "</div>";
    }
    else
        
    {
        echo "<div class=\"container\" style=\"margin-top:40px;\">";
       
        blogAddOpslaan();
        echo "</div>";
    }
    
}

fFooter($pageNavId);

?>
