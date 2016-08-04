<?php
 
function reactieOverzicht()//administrator overzicht
{
    global $connection;

    
     if(isset($_GET['reactEdit_page']))
     {
      $_SESSION['reactEdit_page']=$_GET['reactEdit_page'];
    
      }
   else
      {
        if (!isset($_SESSION['reactEdit_page']))
           {
             $_SESSION['reactEdit_page']=0;
            }
       }

    
   /* $start=$_SESSION['reactEdit_page']*10;
    $prev = $_SESSION['reactEdit_page']-1;
    $next = $_SESSION['reactEdit_page']+1;
    $from = $_SESSION['reactEdit_page']*10+1;
    $to = $_SESSION['reactEdit_page'] * 10 + 10; */
    
    $qpp = 10;
    $start=$_SESSION['reactEdit_page']*$qpp;
    $prev = $_SESSION['reactEdit_page']-1;
    $next = $_SESSION['reactEdit_page']+1;
    $from = $_SESSION['reactEdit_page']*$qpp+1;
    $to = $_SESSION['reactEdit_page'] * $qpp + $qpp;
    
    $reacties = mysqli_query($connection, "SELECT * FROM reactie WHERE reactie_display='y'AND reactie_status='aan' ORDER BY blog_id ") or die(mysqli_error());
    $count_reacties = mysqli_num_rows($reacties);
    
    
    $objecten = mysqli_query($connection, "SELECT * FROM reactie WHERE reactie_display='y'AND reactie_status='aan' ORDER BY blog_id LIMIT $start,10") or die(mysqli_error());
    if (mysqli_num_rows($objecten) == 0) 
    {
         die("<i>Nog geen blogs aanwezig !</i>");
    }
        global $path;
        echo "<table id=\"edit\" cellpadding=\"3\" cellspacing=\"3\" >";
        echo "<tr>";
        echo "<th width=\"50\" align=\"left\">Edit</th>";
        echo "<th width=\"50\" align=\"left\">Blog_id</th>";
        echo "<th width=\"50\" align=\"left\">Reactie_id</th>";
        echo "<th width=\"50\" align=\"left\">Postdate</th>";
        echo "<th width=\"50\" align=\"left\">User</th>";
        echo "<th width=\"50\" align=\"left\">Content</th>";

        echo "<th width=\"50\" align=\"left\">Display</th>";
        echo "</tr>";

	while ($bericht = mysqli_fetch_object($objecten)) 
        {
            echo "<tr>";
            echo "<td width=\"50\" align=\"left\"><a href=\"".$_SERVER['PHP_SELF']."?reactie_id=".$bericht->reactie_id."\">edit</a></td>";
            echo "<td>".utf8_encode($bericht->blog_id)."</td>";
            echo "<td>".utf8_encode($bericht->reactie_id)."</td>";
            echo "<td>".utf8_encode($bericht->reactie_postdate)."</td>";
            echo "<td>".utf8_encode($bericht->user_inlognaam)."</td>";
            echo "<td>".utf8_encode($bericht->reactie_content)."</td>";
            echo "<td>".utf8_encode($bericht->reactie_display)."</td>";
            
        }
        echo "<tr><td colspan='3'></td>";
        //echo "<tr><td>".($prev>=0?"<a href=reactieEdit.php?page=".$prev."> prev</a>":"prev")."</td>";
        //echo "<td>$from..$to</td>";
        //echo "<td>".(mysqli_num_rows($objecten)>9?"<a href=reactieEdit.php?page=".$next."> next</a>":"next")."</td>";
        
        echo "<tr><td>".($prev>=0?"<a href=reactieEdit.php?reactEdit_page=".$prev."> prev</a>":"prev")."</td>";
        echo "<td>$from..$to</td>";
        echo "<td>".(($count_reacties - $to)>0?"<a href=reactieEdit.php?reactEdit_page=".$next."> next</a>":"next")."</td>"; 
        echo "</tr>";  
        echo "</table>";
}

function reactieBewerken()
{
    global $connection;

    if (!isset($_GET['reactie_id']))
    {
        redirect($_SERVER['PHP_SELF']);
        die();
    }
    $bericht = mysqli_query($connection, "SELECT * FROM reactie WHERE reactie_display='y' AND reactie_status='aan' AND reactie_id = ".$_GET['reactie_id']." LIMIT 1") or die(mysqli_error());
    if (mysqli_num_rows($bericht) == 0)
    {
        die("Deze reactie bestaat niet !");
    }
    $bericht = mysqli_fetch_object($bericht);
    echo "Wijzigen van Reactie-content: <a class=\"edit\">".utf8_encode($bericht->reactie_content)."</a> met ID: <a class=\"edit\">".($bericht->reactie_id)."</a><br /><br />";
    echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" enctype=\"multipart/form-data\">";
    echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"2\">";
    echo "<tr><td width=\"150\">Blog_content:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->reactie_content)."\" size=\"250\" name=\"reactie_content\" /></td></tr>";
    echo "<tr><td width=\"150\">Blog_postdate:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->reactie_postdate)."\" size=\"50\" name=\"reactie_postdate\" /></td></tr>";
    echo "<tr><td width=\"150\">display:</td>";
    if ($bericht->reactie_display=="y")
    {
        echo "<td><input type=\"radio\" name=\"reactie_display\" value=\"y\" checked> y &nbsp;&nbsp; ";
        echo "<input type=\"radio\" name=\"reactie_display\" value=\"no\"> n </td>";
    } else
    {
        echo "<td><input type=\"radio\" name=\"reactie_display\" value=\"y\"> y &nbsp;&nbsp;";
        echo "<input type=\"radio\" name=\"reactie_display\" value=\"n\" checked> n </td>";        
    }
    echo "<tr><td colspan=\"2\">";
    echo "<table>";
    echo "<tr><td valign=\"top\">reactie_content:<br />";
    $oFCKeditor = new FCKeditor('reactie_content') ;
    $oFCKeditor->BasePath = "../FCKeditor/";
    $oFCKeditor->Value = utf8_encode($bericht->reactie_content);
    $oFCKeditor->Width = 600;
    $oFCKeditor->Height = 400;
    $oFCKeditor->Create();
    echo "</td></tr>";
    echo "</table>";
    echo "</td></tr>";
    echo "<tr><td>&nbsp;</td>";
    echo "<td><input type=\"hidden\" name=\"reactie_id\" value=\"".$bericht->reactie_id."\" />";
    echo "<input type=\"submit\" name=\"submit_edit_item\" value=\" Opslaan !\" /></td></tr>";
    echo "</table>";
    echo "</form>";
}


function reactieBewerktOpslaan()
{   
    global $connection;

    $zoek = array("'", "á", "é", "í", "ó", "ú", "ñ", "ç", "Á", "É", "Í", "Ó", "Ú", "Ñ", "Ç", "à", "è", "ì", "ò", "ù", "À", "È", "Ì", "Ò", "Ù",
     "ä", "ë", "ï", "ö", "ü", "Ä", "Ë", "Ï", "Ö", "Ü", "â", "ê", "î", "ô", "û", "Â", "Ê", "Î", "Ô", "Û", "ā", "ū", "ś", "ī");

    $maakentity = array("&acute;", "&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;", "&ccedil;", "&Aacute;",
    "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;", "&Ccedil;", "&agrave;", "&egrave;", "&igrave;", "&ograve;",
     "&ugrave;", "&Agrave;", "&Egrave;", "&Igrave;", "&Ograve;", "&Ugrave;", "&auml;", "&euml;", "&iuml;", "&ouml;",
    "&uuml;", "&Auml;", "&Euml;", "&Iuml;", "&Ouml;", "&Uuml;", "&acirc;", "&ecirc;", "&icirc;", "&ocirc;", "&ucirc;", "&Acirc;",
    "&Ecirc;", "&Icirc;", "&Ocirc;", "&Ucirc;", "&#257;", "&#363;", "&#347;", "&#299;");

    $reactie_id=(trim($_POST['reactie_id']));            
    
    $reactie_content=(trim($_POST['reactie_content']));          
    $reactie_content = str_replace($zoek, $maakentity, $reactie_content);
    
    $reactie_postdate = (trim($_POST['reactie_postdate']));
    $reactie_postdate = str_replace($zoek, $maakentity, $reactie_postdate);
    
    $reactie_display=(trim($_POST['reactie_display']));          
    $reactie_display = str_replace($zoek, $maakentity, $reactie_display);


    if (isset($_POST['submit_edit_item']))
    {
        mysqli_query($connection, "UPDATE `reactie` SET `reactie_id` ='".$_POST['reactie_id']."', `reactie_content` ='".$reactie_content."',"
                . " `reactie_postdate`='".$reactie_postdate."', `reactie_display` = '".$reactie_display."' "
                . "WHERE `reactie_id` = ".$_POST['reactie_id']."")
                or die(mysqli_error());
       
    }
    $result_id=$_POST['reactie_id'];
    showTekstReactie($result_id);
    echo "</div>";
}

function showTekstReactie($result_id)//admin functie
{
    global $connection;

    $result_sql = mysqli_query($connection, "SELECT * FROM reactie WHERE reactie_id=".$result_id."");
    while($q=mysqli_fetch_array($result_sql))
    {
        echo "De tekst is gewijzigd en ziet er als onderstaand uit.<br />";
        echo "<a href=\"".$_SERVER['PHP_SELF']."?reactie_id=".$q['reactie_id']."\" >Klik hier als u nog iets in de tekst wilt veranderen.</a><br /><br />";
        echo "<table cellpadding=\"2\">"; // width=\"90%\">";
        echo "<tr><th>ReactieID:&nbsp;</th><td class=\"kleur\">".$q['reactie_id']."</td></tr>";
        echo "<tr><th>reactie_postdate:&nbsp;</th><td class=\"kleur\">".$q['reactie_postdate']."</td></tr>";
        echo "<tr><th>reactie_content:&nbsp;</th><td class=\"kleur\">".$q['reactie_content']."</td></tr>";
    
        echo "<tr><th>Display: &nbsp;</th><td class=\"kleur\">".$q['reactie_display']."</td></tr>";
        
        echo "</tr>";
        echo "</table><p><hr/ height=\"3px\"></p>";
        reactieOverzicht();//administrator reactie-overzicht
    }
}

function overzichtReactieDelete()//administrator Blog-overzicht,selectie te verwijderen blog
{
    global $connection;

    
     if(isset($_GET['reactDelete_page']))
     {
      $_SESSION['reactDelete_page']=$_GET['reactDelete_page'];
    
      }
   else
      {
        if (!isset($_SESSION['reactDelete_page']))
           {
             $_SESSION['reactDelete_page']=0;
            }
       }
    $qpp= 5;  
    $start=$_SESSION['reactDelete_page']*$qpp;
    $prev = $_SESSION['reactDelete_page']-1;
    $next = $_SESSION['reactDelete_page']+1;
    $from = $_SESSION['reactDelete_page']*$qpp+1;
    $to = $_SESSION['reactDelete_page'] * $qpp + $qpp;

    $reacties_del = mysqli_query($connection, "SELECT * FROM reactie WHERE reactie_display='y' AND reactie_status='aan' ") or die(mysqli_error());   
    $count_reacties_del = mysqli_num_rows($reacties_del);  

    
   /* $start=$_SESSION['reactDelete_page']*5;
    $prev = $_SESSION['reactDelete_page']-1;
    $next = $_SESSION['reactDelete_page']+1;
    $from = $_SESSION['reactDelete_page']*5+1;
    $to = $_SESSION['reactDelete_page'] * 5 + 5; */
    
    

    $objecten = mysqli_query($connection, "SELECT * FROM reactie WHERE reactie_display='y' AND reactie_status='aan'  ORDER BY `blog_id` DESC LIMIT $start,5") or die(mysqli_error());
    if (mysqli_num_rows($objecten) == 0) 
    {
         die("<i>Nog geen blogs aanwezig !</i>");
    }
         echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" enctype=\"multipart/form-data\">";
        echo "<table id=\"edit\" cellpadding=\"3\" cellspacing=\"3\" >";
        echo "<tr>";
        echo "<th width=\"50\" align=\"left\">Delete</th>";
        echo "<th width=\"50\" align=\"left\">Blog-id</th>";
        echo "<th width=\"50\" align=\"left\">Reactie-id</th>";
        echo "<th width=\"50\" align=\"left\">Reactie-content</th>";
        echo "<th width=\"50\" align=\"left\">reactie-postdate</th>";
        echo "<th width=\"50\" align=\"left\">reactie-tijdstip</th>";
  
        echo "<th width=\"50\" align=\"left\">Display</th>";
        echo "</tr>";

	while ($bericht = mysqli_fetch_object($objecten)) 
        {
            echo "<tr>";
            echo "<td width=\"50\" align=\"left\"><a href=\"".$_SERVER['PHP_SELF']."?blog_id=".$bericht->blog_id."\">Delete</a></td>";
            echo "<td>".utf8_encode($bericht->blog_id)."</td>";
            echo "<td>".utf8_encode($bericht->reactie_id)."</td>";
            echo "<td>".utf8_encode($bericht->reactie_content)."</td>";
            echo "<td>".utf8_encode($bericht->reactie_postdate)."</td>";
            echo "<td>".utf8_encode($bericht->reactie_tijdstip)."</td>";
            echo "<td>".utf8_encode($bericht->reactie_display)."</td>";
        }
        
        global $path;
        echo "<table>";
        echo "<tr><td colspan='3'></td>";
        //echo "<tr><td>".($prev>=0?"<a href=reactieDelete.php?page=".$prev."> prev</a>":"prev")."</td>";
        //echo "<td>$from..$to</td>";
        //echo "<td>".(mysqli_num_rows($objecten)>4?"<a href=reactieDelete.php?page=".$next."> next</a>":"next")."</td>";
        echo "<tr><td>".($prev>=0?"<a href=reactieDelete.php?reactDelete_page=".$prev."> prev</a>":"prev")."</td>";
        echo "<td>$from..$to</td>";
        echo "<td>".(($count_reacties_del - $to)>0?"<a href=reactieDelete.php?reactDelete_page=".$next."> next</a>":"next")."</td>";
     
        echo "</tr>";  
        echo "</table>";
}




function reactieDelete()
{
    global $connection;

    if (!isset($_GET['blog_id']))
    {
        redirect($_SERVER['PHP_SELF']);
        die();
    }
    else
    {
        mysqli_query($connection, "UPDATE `reactie` SET `reactie_display` = 'n',`reactie_status`='del' WHERE `reactie_id` = ".$_POST['reactie_id']."")
                or die(mysqli_error());  
    }
    //$bericht = mysqli_query($connection, "DELETE  FROM `reactie` WHERE `blog_id` = '".$_GET['blog_id']."' LIMIT 1") or die(mysqli_error());
    
}

function confirmReactieDelete()
{
        
        echo "De reactie is verwijderd,wilt u nog een reactie verwijderen ?.<br />";
     
        overzichtReactieDelete();//administrator overzicht
   
}


function blogDelete()
{
    global $connection;

    if (!isset($_GET['blog_id']))
    {
        redirect($_SERVER['PHP_SELF']);
        die();
    }
    else
      {
        
        $bericht2 =  mysqli_query($connection, "UPDATE `reactie` SET `reactie_display` = 'n',`reactie_status` ='del'WHERE `blog_id` = ".$_GET['blog_id']."")
                or die(mysqli_error());  
        $bericht = mysqli_query($connection, "UPDATE `weblog` SET `blog_display`='n',`blog_status`='del' WHERE `blog_id` = ".$_GET['blog_id']."")
                or die(mysqli_error());
       }
    //$bericht2 = mysqli_query($connection, "DELETE  FROM `reactie` WHERE `blog_id` = '".$_GET['blog_id']."' LIMIT 1") or die(mysqli_error());
    //$bericht = mysqli_query($connection, "DELETE  FROM `weblog` WHERE `blog_id` = '".$_GET['blog_id']."' LIMIT 1") or die(mysqli_error());

}
function overzicht()//administrator Blog-overzicht
{
    global $connection;

    $GLOBALS['path']="http://localhost/psinfo/";
    global $path;
    
     if(isset($_GET['blogEdit_page']))
     {
      $_SESSION['blogEdit_page']=$_GET['blogEdit_page'];
    
      }
   else
      {
        if (!isset($_SESSION['blogEdit_page']))
           {
             $_SESSION['blogEdit_page']=0;
            }
       }
    
   $qpp= 5;
   $start=$_SESSION['blogEdit_page']*$qpp;
   $prev = $_SESSION['blogEdit_page']-1;
   $next = $_SESSION['blogEdit_page']+1;
   $from = $_SESSION['blogEdit_page']*$qpp+1;
   $to = $_SESSION['blogEdit_page'] * $qpp + $qpp;
   
  /* $start=$_SESSION['blogEdit_page']*5;
    $prev = $_SESSION['blogEdit_page']-1;
    $next = $_SESSION['blogEdit_page']+1;
    $from = $_SESSION['blogEdit_page']*5+1;
    $to = $_SESSION['blogEdit_page'] * 5 + 5; */
    
    $blogs = mysqli_query($connection, "SELECT * FROM weblog WHERE blog_display='y' AND `blog_status`='aan'") or die(mysqli_error());  
    $count_blogs = mysqli_num_rows($blogs);
    $objecten = mysqli_query($connection, "SELECT * FROM weblog WHERE blog_display='y' AND `blog_status`='aan' LIMIT $start,5") or die(mysqli_error());
    if (mysqli_num_rows($objecten) == 0) 
    {
         die("<i>Nog geen blogs aanwezig !</i>");
    }
       
        echo "<table id=\"edit\" cellpadding=\"3\" cellspacing=\"3\" >";
        echo "<tr>";
        echo "<th width=\"50\" align=\"left\">Edit</th>";
        echo "<th width=\"50\" align=\"left\">Blog_id</th>";
        echo "<th width=\"50\" align=\"left\">Titel</th>";
        echo "<th width=\"50\" align=\"left\">Summary</th>";
        echo "<th width=\"50\" align=\"left\">Content</th>";
        echo "<th width=\"50\" align=\"left\">Postdate</th>";
  
        echo "<th width=\"50\" align=\"left\">Display</th>";
        echo "</tr>";

	while ($bericht = mysqli_fetch_object($objecten)) 
        {
            echo "<tr>";
            echo "<td width=\"50\" align=\"left\"><a href=\"".$_SERVER['PHP_SELF']."?blog_id=".$bericht->blog_id."\">edit</a></td>";
            echo "<td>".utf8_encode($bericht->blog_id)."</td>";
            echo "<td>".utf8_encode($bericht->blog_title)."</td>";
            echo "<td>".utf8_encode($bericht->blog_summary)."</td>";
            echo "<td>".utf8_encode($bericht->blog_content)."</td>";
            echo "<td>".utf8_encode($bericht->blog_postdate)."</td>";
            echo "<td>".utf8_encode($bericht->blog_display)."</td>";
            
        }
        echo "<tr><td colspan='3'></td>";
        //echo "<tr><td>".($prev>=0?"<a href=blogEdit.php?page=".$prev."> prev</a>":"prev")."</td>";
        //echo "<td>$from..$to</td>";
        //echo "<td>".(mysqli_num_rows($objecten)>5?"<a href=blogEdit.php?page=".$next."> next</a>":"next")."</td>";
        
        echo "<tr><td>".($prev>=0?"<a href=blogEdit.php?blogEdit_page=".$prev."> prev</a>":"prev")."</td>";
        echo "<td>$from..$to</td>";
        echo "<td>".(($count_blogs - $to)>0?"<a href=blogEdit.php?blogEdit_page=".$next."> next</a>":"next")."</td>";  
        echo "</tr>";    
        echo "</table>";
        
}

function overzichtDelete()//administrator Blog-overzicht,selectie te verwijderen blog
{
    global $connection;

    $GLOBALS['path']="http://localhost/psinfo/";
    global $path;
    
     if(isset($_GET['blogDelete_page']))
     {
      $_SESSION['blogDelete_page']=$_GET['blogDelete_page'];
    
      }
   else
      {
        if (!isset($_SESSION['blogDelete_page']))
           {
             $_SESSION['blogDelete_page']=0;
            }
       }

    $qpp = 5;
    $start=$_SESSION['blogDelete_page']*$qpp;
    $prev = $_SESSION['blogDelete_page']-1;
    $next = $_SESSION['blogDelete_page']+1;
    $from = $_SESSION['blogDelete_page']*$qpp+1;
    $to = $_SESSION['blogDelete_page'] * $qpp + $qpp;
    
    
   /* $start=$_SESSION['blogDelete_page']*5;
    $prev = $_SESSION['blogDelete_page']-1;
    $next = $_SESSION['blogDelete_page']+1;
    $from = $_SESSION['blogDelete_page']*5+1;
    $to = $_SESSION['blogDelete_page'] * 5 + 5; */
    
    $blog_del= mysqli_query($connection, "SELECT * FROM weblog WHERE blog_display='y' AND blog_status='aan' ") or die(mysqli_error());
    $count_blog_del = mysqli_num_rows($blog_del);
    $objecten = mysqli_query($connection, "SELECT * FROM weblog WHERE blog_display='y' AND blog_status='aan'  ORDER BY `blog_id` DESC LIMIT $start,5") or die(mysqli_error());
    if (mysqli_num_rows($objecten) == 0) 
    {
         die("<i>Nog geen blogs aanwezig !</i>");
    }
         echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" enctype=\"multipart/form-data\">";
        echo "<table id=\"edit\" cellpadding=\"3\" cellspacing=\"3\" >";
        echo "<tr>";
        echo "<th width=\"50\" align=\"left\">Delete</th>";
        echo "<th width=\"50\" align=\"left\">Blog_id</th>";
        echo "<th width=\"50\" align=\"left\">Titel</th>";
        echo "<th width=\"50\" align=\"left\">Summary</th>";
        echo "<th width=\"50\" align=\"left\">Content</th>";
        echo "<th width=\"50\" align=\"left\">Postdate</th>";
  
        echo "<th width=\"50\" align=\"left\">Display</th>";
        echo "</tr>";

	while ($bericht = mysqli_fetch_object($objecten)) 
        {
            echo "<tr>";
            echo "<td width=\"50\" align=\"left\"><a href=\"".$_SERVER['PHP_SELF']."?blog_id=".$bericht->blog_id."\">Delete</a></td>";
            echo "<td>".utf8_encode($bericht->blog_id)."</td>";
            echo "<td>".utf8_encode($bericht->blog_title)."</td>";
            echo "<td>".utf8_encode($bericht->blog_summary)."</td>";
            echo "<td>".utf8_encode($bericht->blog_content)."</td>";
            echo "<td>".utf8_encode($bericht->blog_postdate)."</td>";
            echo "<td>".utf8_encode($bericht->blog_display)."</td>";
            
        }
        global $path;
        echo "<table>";
        echo "<tr><td colspan='3'></td>";
        //echo "<tr><td>".($prev>=0?"<a href=blogDelete.php?page=".$prev."> prev</a>":"prev")."</td>";
        //echo "<td>$from..$to</td>";
        //echo "<td>".(mysqli_num_rows($objecten)>4?"<a href=blogDelete.php?page=".$next."> next</a>":"next")."</td>";
        
        echo "<tr><td>".($prev>=0?"<a href=blogDelete.php?blogDelete_page=".$prev."> prev</a>":"prev")."</td>";
        echo "<td>$from..$to</td>";
        echo "<td>".(($count_blog_del - $to)>0?"<a href=blogDelete.php?blogDelete_page=".$next."> next</a>":"next")."</td>";
        echo "</tr>"; 
        echo "</table>";
}

function confirmDelete()//admin functie
{
        
        echo "De blog is verwijderd,wilt u nog een blog verwijderen ?.<br />";
     
        overzichtDelete();//administrator overzicht
   
}



function blogBewerken()
{
    global $connection;

    if (!isset($_GET['blog_id']))
    {
        redirect($_SERVER['PHP_SELF']);
        die();
    }
    $bericht = mysqli_query($connection, "SELECT * FROM weblog WHERE blog_id = ".$_GET['blog_id']." LIMIT 1") or die(mysqli_error());
    if (mysqli_num_rows($bericht) == 0)
    {
        die("Deze blog bestaat niet !");
    }
    $bericht = mysqli_fetch_object($bericht);
    echo "Wijzigen van blogtitel: <a class=\"edit\">".utf8_encode($bericht->blog_title)."</a> met ID: <a class=\"edit\">".($bericht->blog_id)."</a><br /><br />";
    echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" enctype=\"multipart/form-data\">";
    echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"2\">";
     echo "<tr><td width=\"150\">Blog_titel:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->blog_title)."\" size=\"50\" name=\"blog_title\" /></td></tr>";
    echo "<tr><td width=\"150\">Boek_summary:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->blog_summary)."\" size=\"50\" name=\"blog_summary\" /></td></tr>";
    echo "<tr><td width=\"150\">Blog_content:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->blog_content)."\" size=\"50\" name=\"blog_content\" /></td></tr>";
    echo "<tr><td width=\"150\">Blog_postdate:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->blog_postdate)."\" size=\"50\" name=\"blog_postdate\" /></td></tr>";
    echo "<tr><td width=\"150\">display:</td>";
    if ($bericht->blog_display=="y")
    {
        echo "<td><input type=\"radio\" name=\"blog_display\" value=\"y\" checked> y &nbsp;&nbsp; ";
        echo "<input type=\"radio\" name=\"blog_display\" value=\"n\"> n </td>";
    } else
    {
        echo "<td><input type=\"radio\" name=\"blog_display\" value=\"y\"> y &nbsp;&nbsp;";
        echo "<input type=\"radio\" name=\"blog_display\" value=\"n\" checked> n </td>";        
    }
    echo "<tr><td colspan=\"2\">";
    echo "<table>";
    echo "<tr><td valign=\"top\">Blog_content:<br />";
    $oFCKeditor = new FCKeditor('blog_content') ;
    $oFCKeditor->BasePath = "../FCKeditor/";
    $oFCKeditor->Value = utf8_encode($bericht->blog_content);
    $oFCKeditor->Width = 600;
    $oFCKeditor->Height = 400;
    $oFCKeditor->Create();
    echo "</td></tr>";
    echo "</table>";
    echo "</td></tr>";
    echo "<tr><td>&nbsp;</td>";
    echo "<td><input type=\"hidden\" name=\"blog_id\" value=\"".$bericht->blog_id."\" />";
    echo "<input type=\"submit\" name=\"submit_edit_item\" value=\" Opslaan !\" /></td></tr>";
    echo "</table>";
    echo "</form>";
}

function blogBewerktOpslaan()
{   
    global $connection;

    $zoek = array("'", "á", "é", "í", "ó", "ú", "ñ", "ç", "Á", "É", "Í", "Ó", "Ú", "Ñ", "Ç", "à", "è", "ì", "ò", "ù", "À", "È", "Ì", "Ò", "Ù",
     "ä", "ë", "ï", "ö", "ü", "Ä", "Ë", "Ï", "Ö", "Ü", "â", "ê", "î", "ô", "û", "Â", "Ê", "Î", "Ô", "Û", "ā", "ū", "ś", "ī");

    $maakentity = array("&acute;", "&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;", "&ccedil;", "&Aacute;",
    "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;", "&Ccedil;", "&agrave;", "&egrave;", "&igrave;", "&ograve;",
     "&ugrave;", "&Agrave;", "&Egrave;", "&Igrave;", "&Ograve;", "&Ugrave;", "&auml;", "&euml;", "&iuml;", "&ouml;",
    "&uuml;", "&Auml;", "&Euml;", "&Iuml;", "&Ouml;", "&Uuml;", "&acirc;", "&ecirc;", "&icirc;", "&ocirc;", "&ucirc;", "&Acirc;",
    "&Ecirc;", "&Icirc;", "&Ocirc;", "&Ucirc;", "&#257;", "&#363;", "&#347;", "&#299;");

    $blog_id=(trim($_POST['blog_id']));          
    
    $blog_title=(trim($_POST['blog_title']));          
    $blog_title = str_replace($zoek, $maakentity, $blog_title);
    
    $blog_summary=(trim($_POST['blog_summary']));
    $blog_summary = str_replace($zoek, $maakentity, $blog_summary);      
    
    $blog_content=(trim($_POST['blog_content']));          
    $blog_content = str_replace($zoek, $maakentity, $blog_content);
    
    $blog_postdate = (trim($_POST['blog_postdate']));
    $blog_postdate = str_replace($zoek, $maakentity, $blog_postdate);
    
    $blog_display=(trim($_POST['blog_display']));          
    $blog_display = str_replace($zoek, $maakentity, $blog_display);


    if (isset($_POST['submit_edit_item']))
    {
        mysqli_query($connection, "UPDATE `weblog` SET `blog_id` ='".$_POST['blog_id']."', `blog_title` ='".$blog_title."',"
                . " `blog_summary`='".$blog_summary."' , `blog_content` ='".$blog_content."',"
                . " `blog_postdate` = '".$blog_postdate."', "
                . "`blog_display`='".$blog_display."' WHERE `blog_id` = ".$_POST['blog_id']." ")
                or die(mysqli_error());
       
    }
    $result_id=$_POST['blog_id'];
    show_tekst($result_id);
    echo "</div>";
}

function show_tekst($result_id)//admin functie
{
    global $connection;

    $result_sql = mysqli_query($connection, "SELECT * FROM weblog WHERE blog_id=".$result_id."");
    while($q=mysqli_fetch_array($result_sql))
    {
        echo "De tekst is gewijzigd en ziet er als onderstaand uit.<br />";
        echo "<a href=\"".$_SERVER['PHP_SELF']."?boek_id=".$q['blog_id']."\" >Klik hier als u nog iets in de tekst wilt veranderen.</a><br /><br />";
        echo "<table cellpadding=\"2\">"; // width=\"90%\">";
        echo "<tr><th>BoekID:&nbsp;</th><td class=\"kleur\">".$q['blog_id']."</td></tr>";
        echo "<tr><th>Blog-titel:&nbsp;</th><td class=\"kleur\">".$q['blog_title']."</td></tr>";
        echo "<tr><th>Blog_summary:&nbsp;</th><td class=\"kleur\">".$q['blog_summary']."</td></tr>";
        echo "<tr><th>Blog_content:&nbsp;</th><td class=\"kleur\">".$q['blog_content']."</td></tr>";
        echo "<tr><th>Boek_postdate:&nbsp;</th><td class=\"kleur\">".$q['blog_postdate']."</td></tr>";
        echo "<tr><th>Display: &nbsp;</th><td class=\"kleur\">".$q['blog_display']."</td></tr>";
        
        echo "</tr>";
        echo "</table><p><hr/ height=\"3px\"></p>";
        overzicht();//administrator overzicht
    }
}

function blogAddShowForm()//admin functie
{
    $posttijdstip = date("H:i");
    $postdate = date("Y-m-d");
    echo "<h4>Invoer van een nieuwe blog</h4>";
    echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" enctype=\"multipart/form-data\">";
    echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"2\">";
    echo "<tr><td width=\"150\">Titel:</td>";
    echo "<td><input type=\"text\" name=\"title\" /></td></tr>";
    echo "<tr><td width=\"150\">Summary:</td>";
    echo "<td><input type=\"text\" name=\"summary\" /></td></tr>";
    echo "<tr><td width=\"150\">Content:</td>";
    echo "<td><input type=\"text\" name=\"content\" /></td></tr>";
    echo "<tr><td width=\"150\">Postdate(jjjj-mm-dd):</td>";
    echo "<td><input type=\"hidden\" name=\"postdate\" value = $postdate></td></tr>";
    echo "<td><input type=\"hidden\" name=\"posttijdstip\" value = $posttijdstip></td></tr>";

    echo "<tr><td width=\"150\">Blog-display(y/n):</td>";
    echo "<td><input type=\"radio\" name=\"display\" value=\"y\" checked> y &nbsp;&nbsp; ";
    echo "<input type=\"radio\" name=\"display\" value=\"n\">n</td>";
    echo "<tr><td colspan=\"2\">";
    echo "<table>";
    echo "<tr><td valign=\"top\">Blog-content:<br />";
    $oFCKeditor = new FCKeditor('content') ;
    $oFCKeditor->BasePath = "../FCKeditor/";
    $oFCKeditor->Value = "";
    $oFCKeditor->Width = 600;
    $oFCKeditor->Height = 400;
    $oFCKeditor->Create();
    echo "</td></tr>";
    echo "</table>";
    echo "</td></tr>";
    echo "<tr><td>&nbsp;</td>";
    echo "<input type=\"submit\" name=\"submit_add_blog\" value=\" uploaden !\" /></td></tr>";
    echo "</table>";
    echo "</form>";
}


function blogAddOpslaan()//admin functie
{
    global $connection;

    $zoek = array("'", "á", "é", "í", "ó", "ú", "ñ", "ç", "Á", "É", "Í", "Ó", "Ú", "Ñ", "Ç", "à", "è", "ì", "ò", "ù", "À", "È", "Ì", "Ò", "Ù",
     "ä", "ë", "ï", "ö", "ü", "Ä", "Ë", "Ï", "Ö", "Ü", "â", "ê", "î", "ô", "û", "Â", "Ê", "Î", "Ô", "Û", "ā", "ū", "ś", "ī");

    $maakentity = array("&acute;", "&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;", "&ccedil;", "&Aacute;",
    "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;", "&Ccedil;", "&agrave;", "&egrave;", "&igrave;", "&ograve;",
     "&ugrave;", "&Agrave;", "&Egrave;", "&Igrave;", "&Ograve;", "&Ugrave;", "&auml;", "&euml;", "&iuml;", "&ouml;",
    "&uuml;", "&Auml;", "&Euml;", "&Iuml;", "&Ouml;", "&Uuml;", "&acirc;", "&ecirc;", "&icirc;", "&ocirc;", "&ucirc;", "&Acirc;",
    "&Ecirc;", "&Icirc;", "&Ocirc;", "&Ucirc;", "&#257;", "&#363;", "&#347;", "&#299;");

    //$blog_id=(trim($_POST['blog_id']));
 
    
    
    $blog_title=(trim($_POST['title']));          
    $blog_title = str_replace($zoek, $maakentity, $blog_title);
    
    $blog_summary=(trim($_POST['summary']));          
    $blog_summary = str_replace($zoek, $maakentity, $blog_summary);
    
    $blog_content=(trim($_POST['content']));          
    $blog_content = str_replace($zoek, $maakentity, $blog_content);
    
    $blog_postdate=(trim($_POST['postdate']));          
    $blog_postdate= str_replace($zoek, $maakentity, $blog_postdate);
    
    $blog_tijdstip=(trim($_POST['posttijdstip']));          
    $blog_tijdstip= str_replace($zoek, $maakentity, $blog_tijdstip);
    
    $blog_display=(trim($_POST['display']));          
    $blog_display = str_replace($zoek, $maakentity, $blog_display);

   
    if (isset($_POST['submit_add_blog']))
    {
        mysqli_query($connection, "INSERT INTO `weblog`(`blog_title`, `blog_content`, `blog_postdate`, `blog_tijdstip`, `blog_summary`, `blog_display`) 
                             VALUES('".$blog_title."' , '".$blog_content."' , '".$blog_postdate."', '".$blog_tijdstip."','".$blog_summary."', '".$blog_display."')") or die(mysqli_error());
      
    }
    echo "<h2>Uw blog is toegevoegd in de database</h2>";
    echo "<h3>nog een <a href=blogAdd.php>blog toevoegen?</a></h3>";
     blogAddShowForm();
    echo "</div>";
    
}
