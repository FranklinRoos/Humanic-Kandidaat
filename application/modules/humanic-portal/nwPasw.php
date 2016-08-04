<?php
session_start();
//09-07-2015
//F.Roos
include("../../config/config.php");
include("../../config/connect.php");
include("../../config/default_functions.php");
include("include/psinfofunctions.php");
$pageNavId=1;
fHeader($active=$pageNavId);
navigatie($active=$pageNavId);

// haal je gegevens voor de pagina uit database

$sql = mysqli_query($connection, "SELECT * FROM `pages` where `page_nav_id`='1' and `page_show` ='y'");
if (mysqli_num_rows($sql)==0)   
{
    die ("Je hebt geen gegevens tot je beschikking");
}
echo "<div class=\"container\">";

while ($content = mysqli_fetch_assoc($sql)) 
{
    echo $content["page_title"];
    
    //echo "<h3>Registration Form</h3>";
    
}
if (!isSet($_POST["submit"]))
{    
    showPaswVergForm();
    fFooter($active=$pageNavId);
} 
else
{    
    handlePaswVergForm($_POST['emailuser']);
    
}
echo "</div>";

?>