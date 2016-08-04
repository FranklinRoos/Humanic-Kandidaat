<?php
session_start();
include("../application/config/config.php");
include("../application/config/connect.php");
include("../application/config/default_functions.php");
include("../application/modules/psinfoportal/include/psinfofunctions.php");

$pageNavId=12;
fHeader($pageNavId);//actief=$pageNavId);
navigatie($pageNavId);
// haal de gegevens voor de pagina uit de database
if (isset($_SESSION["loginnaam"]))//eerst checken of er wel ingelogd is
{
$sql = mysqli_query($connection, "SELECT * FROM `pages` where `page_nav_id`=$pageNavId and `page_show` ='y'");

echo "<div class=\"container\" style=\"margin-top:50px;\">";
if (mysqli_num_rows($sql)==0)   
{
    die ("Je hebt geen gegevens tot je beschikking");
}
while ($content = mysqli_fetch_assoc($sql)) 
{
    echo "<div class=\"col-sm-12\">";
    echo "<h1>".$content["page_title"]."</h1>";
    echo "</div>";
    echo "<br /><p>";
    echo utf8_encode($content["page_content"]);
    echo "<br /><p>";
}

echo "</div>";
}
 else 
     {
       echo "<br /><br /><br /><h2 align=center>Dit is de website van en over Pieter Spierenburg</h2>";
       echo "<br /><h3>U dient eerst<a href=\"login.php\"> ingelogd</a> te zijn</h3>";
    
     }
fFooter();







/*if (isset($_SESSION["loginnaam"]))
{
    echo "<div class=\"clear\">";
    global $imagepath;
    echo "<img src=\"$imagepath"."spierenburg-intro.jpg\" alt=\"pieter spierenburg\" width=\"30%\">";
    echo "<h2>Programmaleider bij het <a href='http://www.niod.nl/nl/medewerker/pieter-spierenburg' TARGET=\"_blank\">NIOD</a></h2>";
    echo"<h2>tevens ook op<a href= https://www.facebook.com/pieter.spierenburg.7?fref=ts TARGET=\"_ blank\"> FACEBOOK</h2></a>";
    echo "</div>";
    fFooter($pageNavId);
}

else
{
    echo "<br /><h2 align=center>Dit is de website van en over Pieter Spierenburg</h2>";
    echo "<br /><h3>U dient eerst<a href=\"login.php\"> ingelogd</a> te zijn</h3>";
    fFooter($pageNavId);
}
*/