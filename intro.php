<?php
session_start();
include("application/config/config.php");
include("application/config/connect.php");
include("application/config/default_functions.php");

$pageNavId=2;
fHeader($pageNavId);//actief=$pageNavId);
if(iSset($_SESSION["user_authorisatie"])&& $_SESSION["user_authorisatie"]=="admin")
  {  navigatieA($pageNavId);
// haal de gegevens voor de pagina uit de database
$sql = mysqli_query($connection, "SELECT * FROM `pages` WHERE `page_nav_id`=$pageNavId and `page_show` ='y'");

echo "<div class=\"container\">";
if (mysqli_num_rows($sql)==0)   
{
    die ("Je hebt geen gegevens tot je beschikking");
}
while ($content = mysqli_fetch_assoc($sql)) 
{   // show de inhoud
    echo "<h1>".$content["page_title"]."</h1>";
    echo "<br /><p>";
    echo utf8_encode($content["page_content"]);
    echo "<br /><p>";
   
//}?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

</head>
<body>

<video controls>
  <source src="assets/movies/Pieter_Spierenburg_intro.swf" type="video/swf">
  <source src="assets/movies/Pieter_Spierenburg_intro.ogg" type="video/ogg; codecs=dirac, speex">
 <source src="assets/movies/Pieter_Spierenburg_intro.mp4" type="video/mp4">
  Het <code>video</code> element wordt niet ondersteund door uw browser.
</video>
<script>
   var v = document.getElementsByTagName("video")[0];
v.play(); 
    
</script>

</html>
<?php
 echo "</div>";
}
fFooter();
}
else
 {
     navigatie($pageNavId);
// haal de gegevens voor de pagina uit de database
$sql = mysqli_query($connection, "SELECT * FROM `pages` WHERE `page_nav_id`=$pageNavId and `page_show` ='y'");

echo "<div class=\"container\">";
if (mysqli_num_rows($sql)==0)   
{
    die ("Je hebt geen gegevens tot je beschikking");
}
while ($content = mysqli_fetch_assoc($sql)) 
{   // show de inhoud
    echo "<h1>".$content["page_title"]."</h1>";
    echo "<br /><p>";
    echo utf8_encode($content["page_content"]);
    echo "<br /><p>";
   
//}?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

</head>
<body>

<video controls>
  <source src="assets/movies/Pieter_Spierenburg_intro.swf" type="video/swf">
  <source src="assets/movies/Pieter_Spierenburg_intro.ogg" type="video/ogg; codecs=dirac, speex">
 <source src="assets/movies/Pieter_Spierenburg_intro.mp4" type="video/mp4">
  Het <code>video</code> element wordt niet ondersteund door uw browser.
</video>
<script>
   var v = document.getElementsByTagName("video")[0];
v.play(); 
    
</script>


</html>
<?php
 echo "</div>";
}
fFooter();
}
