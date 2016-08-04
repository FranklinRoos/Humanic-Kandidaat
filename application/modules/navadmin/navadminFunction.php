<?php

function overzicht()
{
    global $connection;

    
    $objecten = mysqli_query($connection, "SELECT * FROM navadmin") or die(mysqli_error());
    if (mysqli_num_rows($objecten) == 0) 
    {
        die("<i>Nog geen navigatie aanwezig!</i>");
    }
        echo "<table id=\"edit\" cellpadding=\"3\" cellspacing=\"3\" style=\"border:1px solid;\" >";
        echo "<tr>";
        echo "<th width=\"50\" align=\"left\">Edit</th>";
        echo "<th width=\"150\" align=\"left\">Navadmin_naam</th>";
        echo "<th width=\"450\" align=\"left\">Navadmin_url</th>";
        echo "<th width=\"150\" align=\"left\">Navadmin_show</th>";        
        echo "</tr>";

	while ($bericht = mysqli_fetch_object($objecten)) 
        {
            echo "<tr>";
            echo "<td width=\"50\" align=\"left\"><a href=\"".$_SERVER['PHP_SELF']."?navadmin_id=".$bericht->navadmin_id."\">edit</a></td>";
            echo "<td>".utf8_encode($bericht->navadmin_naam)."</td>";
            echo "<td><h3>".utf8_encode($bericht->navadmin_url)."</h3></td>";
            echo "<td><h3>".utf8_encode($bericht->navadmin_show)."</h3></td>";
            echo "</tr>";
        }
        echo "</table>";
}

function navBewerken()
{
    global $connection;

    if (!isset($_GET['navadmin_id']))
    {
        redirect($_SERVER['PHP_SELF']);
        die();
    }
    $bericht = mysqli_query($connection, "SELECT * FROM navadmin WHERE navadmin_id = ".$_GET['navadmin_id']." LIMIT 1") or die(mysqli_error());
    if (mysqli_num_rows($bericht) == 0)
    {
        die("nav bestaat niet !");
        echo "</div>";
    }
    $bericht = mysqli_fetch_object($bericht);
    echo "Wijzigen van navadmin: <a class=\"edit\">".utf8_encode($bericht->navadmin_naam)."</a> met id: <a class=\"edit\">".($bericht->navadmin_id)."</a><br /><br />";
    echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" enctype=\"multipart/form-data\">";
    echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"2\">";
    echo "<tr><td width=\"100\">Navadmin-naam:&nbsp;</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->navadmin_naam)."\" size=\"50\" name=\"navadmin_naam\" /></td></tr>";
    echo "<tr><td width=\"100\">Navadmin-url:&nbsp;</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->navadmin_url)."\" size=\"50\" name=\"navadmin_url\" /></td></tr>";
    echo "<tr><td width=\"100\">navadmin-show:&nbsp;</td>";
    if ($bericht->navadmin_show=="y")
    {
        echo "<td><input type=\"radio\" name=\"navadmin_show\" value=\"y\" checked> y &nbsp;&nbsp; ";
        echo "<input type=\"radio\" name=\"navadmin_show\" value=\"n\"> n </td></tr>";
    } else
    {
        echo "<td><input type=\"radio\" name=\"navadmin_show\" value=\"y\"> y &nbsp;&nbsp;";
        echo "<input type=\"radio\" name=\"navadmin_show\" value=\"n\" checked> n </td></tr>";        
    }    
    echo "<tr><td colspan=\"2\">";
    echo "</td></tr>";
    echo "<tr><td>&nbsp;</td>";
    echo "<td><input type=\"hidden\" name=\"navadmin_id\" value=\"".$bericht->navadmin_id."\" />";
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

    $navadmin_naam=(trim($_POST['navadmin_naam']));          
    $navadmin_naam = str_replace($zoek, $maakentity, $navadmin_naam);

    $display=(trim($_POST['navadmin_url']));          
    $navadmin_show=(trim($_POST['navadmin_show']));          
    $navadmin_show = str_replace($zoek, $maakentity, $navadmin_show);

    if (isset($_POST['submit_edit_item']))
    {
        mysqli_query($connection, "UPDATE `navadmin` SET `navadmin_id` ='".$_POST['navadmin_id']."', `navadmin_naam` ='".$navadmin_naam."', `navadmin_show`='".$navadmin_show."' WHERE `navadmin_id` = ".$_POST['navadmin_id']." ") or die(mysqli_error());
    }
    $result_id=$_POST['navadmin_id'];
    show_tekst($result_id); 
}

function show_tekst($result_id)
{
    global $connection;

    $result_sql = mysqli_query($connection, "SELECT * FROM navadmin WHERE navadmin_id=".$result_id."");
    while($q=mysqli_fetch_array($result_sql))
    {
        echo "De tekst is gewijzigd en ziet er als onderstaand uit.<br />";
        echo "<a href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?navadmin_id=".$q['navadmin_id']."\" >Klik hier als u nog iets in de tekst wilt veranderen.</a><br /><br />";
        echo "<table cellpadding=\"2\">";
        echo "<tr><th>Navadmin-naam:&nbsp&nbsp</th><td class=\"kleur\">".$q['navadmin_naam']."</td></tr>";
        echo "<tr><th>Navadmin-url:&nbsp&nbsp</th><td class=\"kleur\">".$q['navadmin_url']."</td></tr>";
        echo "<tr><th>Navadmin-show:&nbsp&nbsp</th><td class=\"kleur\">".$q['navadmin_show']."</td></tr>";
        echo "</table><p><hr/ height=\"3px\"></p>";
        overzicht();
    }
}

?>
