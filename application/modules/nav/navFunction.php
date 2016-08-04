<?php

function overzicht()
{
    global $connection;
    
    $objecten = mysqli_query($connection, "SELECT * FROM nav") or die(mysqli_error());
    if (mysqli_num_rows($objecten) == 0) 
    {
        die("<i>Nog geen navigatie aanwezig!</i>");
    }
        echo "<table id=\"edit\" cellpadding=\"3\" cellspacing=\"3\" style=\"border:1px solid;\" >";
        echo "<tr>";
        echo "<th width=\"50\" align=\"left\">Edit</th>";
        echo "<th width=\"150\" align=\"left\">Nav naam</th>";
        echo "<th width=\"450\" align=\"left\">Nav url</th>";
        echo "<th width=\"150\" align=\"left\">Nav place</th>";
        echo "<th width=\"150\" align=\"left\">Nav taal</th>";
        echo "<th width=\"150\" align=\"left\">Nav authorisatie</th>";
        echo "<th width=\"150\" align=\"left\">Nav show</th>";        
        echo "</tr>";

	while ($bericht = mysqli_fetch_object($objecten)) 
        {
            echo "<tr>";
            echo "<td width=\"50\" align=\"left\"><a href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?nav_id=".$bericht->nav_id."\">edit</a></td>";
            echo "<td>".utf8_encode($bericht->nav_naam)."</td>";
            echo "<td><h3>".utf8_encode($bericht->nav_url)."</h3></td>";
            echo "<td><h3>".utf8_encode($bericht->nav_place)."</h3></td>";
            echo "<td><h3>".utf8_encode($bericht->nav_taal)."</h3></td>";
            echo "<td><h3>".utf8_encode($bericht->nav_auth)."</h3></td>";
            echo "<td><h3>".utf8_encode($bericht->nav_show)."</h3></td>";
            echo "</tr>";
        }
        echo "</table>";
}

function navBewerken()
{
    global $connection;
    
    if (!isset($_GET['nav_id']))
    {
        redirect($_SERVER['PHP_SELF']);
        die();
    }
    $bericht = mysqli_query($connection, "SELECT * FROM nav WHERE nav_id = ".$_GET['nav_id']." LIMIT 1") or die(mysqli_error());
    if (mysqli_num_rows($bericht) == 0)
    {
        die("nav bestaat niet !");
        echo "</div>";
    }
    $bericht = mysqli_fetch_object($bericht);
    echo "Wijzigen van nav: <a class=\"edit\">".utf8_encode($bericht->nav_naam)."</a> met id: <a class=\"edit\">".($bericht->nav_id)."</a><br /><br />";
    echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" enctype=\"multipart/form-data\">";
    echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"2\">";
    echo "<tr><td width=\"100\">Nav naam:</td>";
    echo "<td><input type=\"text\"  value=\"".utf8_encode($bericht->nav_naam)."\" size=\"50\" name=\"nav_naam\" /></td></tr>";
    echo "<tr><td width=\"100\">Nav url:</td>";
    echo "<td><input type=\"text\"  value=\"".utf8_encode($bericht->nav_url)."\" size=\"50\" name=\"nav_url\" /></td></tr>";
    echo "<tr><td width=\"100\">nav place:</td>";
    if ($bericht->nav_place=="header")
    {
        echo "<td><input type=\"radio\" name=\"nav_place\" value=\"header\" checked> header &nbsp;&nbsp; ";
        echo "<input type=\"radio\" name=\"nav_place\" value=\"footer\"> footer </td></tr>";
    } else
    {
        echo "<td><input type=\"radio\" name=\"nav_place\" value=\"header\"> header &nbsp;&nbsp;";
        echo "<input type=\"radio\" name=\"nav_place\" value=\"footer\" checked> footer </td></tr>";        
    }
    echo "<tr><td width=\"100\">nav show:</td>";
    if ($bericht->nav_show=="y")
    {
        echo "<td><input type=\"radio\" name=\"nav_show\" value=\"y\" checked> y &nbsp;&nbsp; ";
        echo "<input type=\"radio\" name=\"nav_show\" value=\"n\"> n </td></tr>";
    } else
    {
        echo "<td><input type=\"radio\" name=\"nav_show\" value=\"y\"> y &nbsp;&nbsp;";
        echo "<input type=\"radio\" name=\"nav_show\" value=\"n\" checked> n </td></tr>";        
    }    
    //echo "<tr><td width=\"150\">image:</td>";
    //echo "<td><input type=\"text\"  value=\"".$bericht->image."\" size=\"50\" name=\"image\" /></td></tr>";
    echo "<tr><td colspan=\"2\">";
    echo "</td></tr>";
    echo "<tr><td>&nbsp;</td>";
    echo "<td><input type=\"hidden\" name=\"nav_id\" value=\"".$bericht->nav_id."\" />";
    echo "<input type=\"submit\" name=\"submit_edit_item\" value=\" Opslaan !\" /></td></tr>";
    echo "</table>";
    echo "</form>";
}

function navBewerktOpslaan()
{  
    global $connection;
     
    $zoek = array("'", "á", "é", "í", "ó", "ú", "ñ", "ç", "Á", "É", "Í", "Ó", "Ú", "Ñ", "Ç", "à", "è", "ì", "ò", "ù", "À", "È", "Ì", "Ò", "Ù",
     "ä", "ë", "ï", "ö", "ü", "Ä", "Ë", "Ï", "Ö", "Ü", "â", "ê", "î", "ô", "û", "Â", "Ê", "Î", "Ô", "Û", "ā", "ū", "ś", "ī");

    $maakentity = array("&acute;", "&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;", "&ccedil;", "&Aacute;",
    "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;", "&Ccedil;", "&agrave;", "&egrave;", "&igrave;", "&ograve;",
     "&ugrave;", "&Agrave;", "&Egrave;", "&Igrave;", "&Ograve;", "&Ugrave;", "&auml;", "&euml;", "&iuml;", "&ouml;",
    "&uuml;", "&Auml;", "&Euml;", "&Iuml;", "&Ouml;", "&Uuml;", "&acirc;", "&ecirc;", "&icirc;", "&ocirc;", "&ucirc;", "&Acirc;",
    "&Ecirc;", "&Icirc;", "&Ocirc;", "&Ucirc;", "&#257;", "&#363;", "&#347;", "&#299;");

    $nav_naam=(trim($_POST['nav_naam']));          
    $nav_naam = str_replace($zoek, $maakentity, $nav_naam);

    $display=(trim($_POST['nav_url']));          
    
    $nav_place=(trim($_POST['nav_place']));          
    $nav_place = str_replace($zoek, $maakentity, $nav_place);
    
    $nav_show=(trim($_POST['nav_show']));          
    $nav_show = str_replace($zoek, $maakentity, $nav_show);

    if (isset($_POST['submit_edit_item']))
    {
        mysqli_query($connection, "UPDATE `nav` SET `nav_id` ='".$_POST['nav_id']."', `nav_naam` ='".$nav_naam."', `nav_place`='".$nav_place."', `nav_show`='".$nav_show."' WHERE `nav_id` = ".$_POST['nav_id']." ") or die(mysqli_error());
    }
    $result_id=$_POST['nav_id'];
    show_tekst($result_id); 
}

function show_tekst($result_id)
{
    global $connection;
    
    $result_sql = mysqli_query($connection, "SELECT * FROM nav WHERE nav_id=".$result_id."");
    while($q=mysqli_fetch_array($result_sql))
    {
        echo "De tekst is gewijzigd en ziet er als onderstaand uit.<br />";
        echo "<a href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?nav_id=".$q['nav_id']."\" >Klik hier als u nog iets in de tekst wilt veranderen.</a><br /><br />";
        echo "<table cellpadding=\"2\">";
        echo "<tr><th>nav naam:&nbsp&nbsp</th><td class=\"kleur\">".$q['nav_naam']."</td></tr>";
        echo "<tr><th>nav url:&nbsp&nbsp</th><td class=\"kleur\">".$q['nav_url']."</td></tr>";
        echo "<tr><th>nav place:&nbsp&nbsp</th><td class=\"kleur\">".$q['nav_place']."</td></tr>";
        echo "<tr><th>nav show:&nbsp&nbsp</th><td class=\"kleur\">".$q['nav_show']."</td></tr>";
        echo "</table><p><hr/ height=\"3px\"></p>";
        overzicht();
    }
}

?>