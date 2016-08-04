<?php

function overzicht()
{
    global $connection;

    $objecten = mysqli_query($connection, "SELECT * FROM pages") or die(mysqli_error());
    if (mysqli_num_rows($objecten) == 0) 
    {
        die("<i>Nog geen page aanwezig!</i>");
    }
        echo "<table id=\"edit\" cellpadding=\"3\" cellspacing=\"3\" style=\"border:1px solid;\" >";
        echo "<tr>";
        echo "<th width=\"50\" align=\"left\">Edit</th>";
        echo "<th width=\"50\" align=\"left\">Page nav id</th>";
        echo "<th width=\"300\" align=\"left\">Page content</th>";
        echo "<th width=\"100\" align=\"left\">Page title</th>";
        echo "<th width=\"200\" align=\"left\">Page description</th>";
        echo "<th width=\"200\" align=\"left\">Page keywords</th>";
        echo "<th width=\"50\" align=\"left\">Show</th>";
        echo "</tr>";

	while ($bericht = mysqli_fetch_object($objecten)) 
        {
            echo "<tr>";
            echo "<td width=\"50\" align=\"left\"><a href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?page_id=".$bericht->page_id."\">edit</a></td>";
            echo "<td>".utf8_encode($bericht->page_nav_id)."</td>";
                        if (strlen($bericht->page_content) >75)
            {
                //strip tags, de tags die NIET gestript moeten worden moet je aangeven
                $tekst= strip_tags($bericht->page_content, "<h1></h1><p></p><br /><br/>");
                $tekst= substr($tekst,0,75)." ... ";
                echo "<td>".utf8_encode($tekst)."</td>";
            } else
            {
                echo "<td>".utf8_encode($bericht->page_content)."</td>";
            }
            echo "<td>".utf8_encode($bericht->page_title)."</td>";
            if (strlen($bericht->page_description) >50)
            {
                //strip tags, de tags die NIET gestript moeten worden moet je aangeven
                $tekst= strip_tags($bericht->page_description, "<h1></h1><p></p><br /><br/>");
                $tekst= substr($tekst,0,50)." ... ";
                echo "<td>".utf8_encode($tekst)."</td>";
            } else
            {
            echo "<td>".utf8_encode($bericht->page_description)."</td>";
            }
            if (strlen($bericht->page_keywords) >50)
            {
                //strip tags, de tags die NIET gestript moeten worden moet je aangeven
                $tekst= strip_tags($bericht->page_keywords, "<h1></h1><p></p><br /><br/>");
                $tekst= substr($tekst,0,50)." ... ";
                echo "<td>".utf8_encode($tekst)."</td>";
            } else
            {
            echo "<td>".utf8_encode($bericht->page_keywords)."</td>";
            }
            echo "<td>".utf8_encode($bericht->page_show)."</td>";
            echo "</tr>";
        }
        echo "</table>";
}

function pageBewerken()
{
    global $connection;

    if (!isset($_GET['page_id']))
    {
        redirect(htmlspecialchars($_SERVER["PHP_SELF"]));
        die();
    }
    $bericht = mysqli_query($connection, "SELECT * FROM pages WHERE page_id = ".$_GET['page_id']." LIMIT 1") or die(mysqli_error());
    if (mysqli_num_rows($bericht) == 0)
    {
        die("Deze page bestaat niet !");
        echo "</div>";
    }
    $bericht = mysqli_fetch_object($bericht);
    echo "Wijzigen van page:&nbsp<a class=\"edit\">".utf8_encode($bericht->page_title)."</a> met ID nummer:&nbsp<a class=\"edit\">".($bericht->page_id)."</a><br /><br />";
    echo "<form action=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\" method=\"POST\" enctype=\"multipart/form-data\">";
    echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"2\">";
    echo "<tr><td width=\"150\">Page_nav_id:</td>";
    echo "<td><input type=\"text\"  value=\"".utf8_encode($bericht->page_nav_id)."\" size=\"5\" name=\"page_nav_id\" /></td></tr>";
    echo "<tr><td width=\"150\">Page title:</td>";
    echo "<td><input type=\"text\"  value=\"".utf8_encode($bericht->page_title)."\" size=\"160\" name=\"page_title\" /></td></tr>";
    echo "<tr><td width=\"150\">Page description:</td>";
    echo "<td><input type=\"text\"  value=\"".utf8_encode($bericht->page_description)."\" size=\"160\" name=\"page_description\" /></td></tr>";
    echo "<tr><td width=\"150\">Page keywords:</td>";
    echo "<td><input type=\"text\"  value=\"".utf8_encode($bericht->page_keywords)."\" size=\"160\" name=\"page_keywords\" /></td></tr>";
    echo "<tr><td width=\"150\">Show:</td>";
    if ($bericht->page_show=="y")
    {
        echo "<td><input type=\"radio\" name=\"page_show\" value=\"y\" checked> y &nbsp;&nbsp; ";
        echo "<input type=\"radio\" name=\"page_show\" value=\"n\"> n </td>";
    } else
    {
        echo "<td><input type=\"radio\" name=\"page_show\" value=\"y\"> y &nbsp;&nbsp;";
        echo "<input type=\"radio\" name=\"page_show\" value=\"n\" checked> n </td>";        
    }
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\">";
    echo "<table>";
    echo "<tr><td valign=\"top\">Page content:<br />";
    $oFCKeditor = new FCKeditor('page_content') ;
    $oFCKeditor->BasePath = "../FCKeditor/";
    $oFCKeditor->Value = utf8_encode($bericht->page_content);
    $oFCKeditor->Width = 600;
    $oFCKeditor->Height = 400;
    $oFCKeditor->Create();
    echo "</td></tr>";
    echo "</table>";

    echo "<tr><td>&nbsp;</td>";
    echo "<td><input type=\"hidden\" name=\"page_id\" value=\"".$bericht->page_id."\" />";
    echo "<input type=\"submit\" name=\"submit_edit_item\" value=\" Opslaan !\" /></td></tr>";
    echo "</table>";
    echo "</form>";
}

function pageBewerktOpslaan()
{   
    global $connection;

    $zoek = array("'", "á", "é", "í", "ó", "ú", "ñ", "ç", "Á", "É", "Í", "Ó", "Ú", "Ñ", "Ç", "à", "è", "ì", "ò", "ù", "À", "È", "Ì", "Ò", "Ù",
     "ä", "ë", "ï", "ö", "ü", "Ä", "Ë", "Ï", "Ö", "Ü", "â", "ê", "î", "ô", "û", "Â", "Ê", "Î", "Ô", "Û", "ā", "ū", "ś", "ī");

    $maakentity = array("&acute;", "&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;", "&ccedil;", "&Aacute;",
    "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;", "&Ccedil;", "&agrave;", "&egrave;", "&igrave;", "&ograve;",
     "&ugrave;", "&Agrave;", "&Egrave;", "&Igrave;", "&Ograve;", "&Ugrave;", "&auml;", "&euml;", "&iuml;", "&ouml;",
    "&uuml;", "&Auml;", "&Euml;", "&Iuml;", "&Ouml;", "&Uuml;", "&acirc;", "&ecirc;", "&icirc;", "&ocirc;", "&ucirc;", "&Acirc;",
    "&Ecirc;", "&Icirc;", "&Ocirc;", "&Ucirc;", "&#257;", "&#363;", "&#347;", "&#299;");

    $page_nav_id=(trim($_POST['page_nav_id']));
    
    $page_content=(trim($_POST['page_content']));          
    $page_content = str_replace($zoek, $maakentity, $page_content);

    $page_title=(trim($_POST['page_title']));          
    $page_title = str_replace($zoek, $maakentity, $page_title);

    $page_description=(trim($_POST['page_description']));          
    $page_description = str_replace($zoek, $maakentity, $page_description);
    
    $page_keywords=(trim($_POST['page_keywords']));          
    $page_keywords = str_replace($zoek, $maakentity, $page_keywords);
    
    $page_show=(trim($_POST['page_show']));
    
    if (isset($_POST['submit_edit_item']))
    {
        mysqli_query($connection, "UPDATE `pages` SET `page_nav_id` ='".$_POST['page_nav_id']."', `page_content` ='".$page_content."', `page_title` ='".$page_title."', `page_description` ='".$page_description."', `page_keywords`='".$page_keywords."', `page_show`='".$page_show."' WHERE `page_id` = ".$_POST['page_id']." ") or die(mysqli_error());
        //UPDATE `artikelen` SET `artikelID`=[value-1],`navid`=[value-2],`artikelnaam`=[value-3],`prijsexbtw`=[value-4],`omschrijving`=[value-5],`page_title`=[value-6],`display`=[value-7],`Update_time`=[value-8] WHERE
    }
    $result_id=$_POST['page_id'];
    show_tekst($result_id); 
}

function show_tekst($result_id)
{
    global $connection;

    $result_sql = mysqli_query($connection, "SELECT * FROM pages WHERE page_id=".$result_id."");
    while($q=mysqli_fetch_array($result_sql))
    {
        echo "De tekst is gewijzigd en ziet er als onderstaand uit.<br />";
        echo "<a href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?page_id=".$q['page_id']."\" >Klik hier als u nog iets in de tekst wilt veranderen.</a><br /><br />";
        echo "<table cellpadding=\"2\">";
        echo "<tr><th>Page nav id:&nbsp&nbsp</th><td class=\"kleur\">".$q['page_nav_id']."</td></tr>";
        echo "<tr><th>Page content:&nbsp&nbsp</th>";
        if (strlen($q['page_content'])>150)
        {
            //strip tags, de tags die NIET gestript moeten worden moet je aangeven
            $tekst= strip_tags($q['page_content'], "<h1><p><br /><br />");
            $tekst= substr($tekst,0,150)." ... ";
            echo "<td class=\"kleur\">".utf8_encode($tekst)."</td>";
        }
            else
        {
        echo "<td class=\"kleur\">".utf8_encode($q['page_content'])."</td>";
        }
        echo "</tr>";
        echo "<tr><th>Page title:&nbsp&nbsp</th><td class=\"kleur\">".$q['page_title']."</td></tr>";
        echo "<tr><th>Page description:&nbsp&nbsp</th><td class=\"kleur\">".$q['page_description']."</td></tr>";
        echo "<tr><th>Page keywords:&nbsp&nbsp</th><td class=\"kleur\">".$q['page_keywords']."</td></tr>";
        echo "<tr><th>Page show:&nbsp&nbsp</th><td class=\"kleur\">".$q['page_show']."</td></tr>";
        echo "</table><p><hr/ height=\"3px\"></p>";
        overzicht();
    }
}

?>
