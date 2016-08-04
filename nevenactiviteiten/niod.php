<?php
session_start();
include("../application/config/config.php");
include("../application/config/connect.php");
include("../application/config/default_functions.php");
include("../application/modules/psinfoportal/include/psinfofunctions.php");


$pageNavId=16;
fHeader($pageNavId);//actief=$pageNavId (voor weergave actieve pagina);
$pageNavId=12; // ** navigatie blijft pagina 12: dit is een subpagina **
navigatie($active=$pageNavId);
$pageNavId=16;

echo "<div class=\"container\">";

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
fFooter();