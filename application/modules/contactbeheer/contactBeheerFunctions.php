<?php

function berichtOverzicht()
{
  global $connection;

  if(isset($_GET['contact_page']))
     {
      $_SESSION['contact_page']=$_GET['contact_page'];
    
      }
   else
      {
        if (!isset($_SESSION['contact_page']))
           {
             $_SESSION['contact_page']=0;
            }
       }

    $aantal_per_pag = 5;
    $start=$_SESSION['contact_page']*$aantal_per_pag;
    $prev = $_SESSION['contact_page']-1;
    $next = $_SESSION['contact_page']+1;
    $from = $_SESSION['contact_page']*$aantal_per_pag+1;
    $to = $_SESSION['contact_page'] * $aantal_per_pag + $aantal_per_pag;
   
   /* $start=$_SESSION['contact_page']*5;
    $prev = $_SESSION['contact_page']-1;
    $next = $_SESSION['contact_page']+1;
    $from = $_SESSION['contact_page']*5+1;
    $to = $_SESSION['contact_page'] * 5 + 5;*/


    $berichten = mysqli_query($connection, "SELECT * FROM contact") or die(mysqli_error());
    $count_berichten = mysqli_num_rows($berichten); 
    
    $objecten = mysqli_query($connection, "SELECT * FROM contact LIMIT $start,5") or die(mysqli_error());
    if (mysqli_num_rows($objecten) == 0) 
    {
        die("<i>Nog geen users aanwezig !</i>");
    }
        echo "<table id=\"edit\" cellpadding=\"3\" cellspacing=\"3\" >";
        echo "<tr>";
        echo "<th width=\"50\" align=\"left\">View</th>";
        echo "<th width=\"50\" align=\"left\">User ID</th>";
        echo "<th width=\"50\" align=\"left\">User Inlognaam</th>";
         echo "<th width=\"50\" align=\"left\">Contact ID</th>"; 
        echo "<th width=\"50\" align=\"left\">Contact Naam</th>";
        echo "<th width=\"50\" align=\"left\">Contact Email</th>";
        echo "<th width=\"50\" align=\"left\">Subject</th>";
        echo "<th width=\"90\" align=\"left\">Bericht</th>";
        echo "</tr>";

	while ($bericht = mysqli_fetch_object($objecten)) 
        {
            echo "<tr>";
            echo "<td width=\"50\" align=\"left\"><a href=\"".$_SERVER['PHP_SELF']."?contact_id=".$bericht->contact_id."\">view</a></td>";
            echo "<td>".utf8_encode($bericht->user_id)."</td>";
            echo "<td>".utf8_encode($bericht->user_inlognaam)."</td>";
            echo "<td>".utf8_encode($bericht->contact_id)."</td>";
            echo "<td>".utf8_encode($bericht->contact_naam)."</td>";
            echo "<td>".utf8_encode($bericht->contact_email)."</td>";
            echo "<td>".utf8_encode($bericht->contact_subject)."</td>";
            echo "<td>".utf8_encode($bericht->contact_bericht)."</td>";
            
            echo "</tr>";
        }
        echo "</table>";     
        echo "<table>";
        echo "<tr><td colspan='3'></td>";
        echo "<tr><td>".($prev>=0?"<a href=contactBeheer.php?contact_page=".$prev. "> prev </a>":"prev")."</td>";
        echo "<td>$from...$to</td>";
        echo "<td>".(($count_berichten - $to)>0?"<a href=contactBeheer.php?contact_page=" .$next. "> next </a>":"next")."</td>";
        echo "</tr>";
        echo "</table>"; 
        
}

function berichtBekijken ()//function userBewerken()
{
    global $connection;

    if (!isset($_GET['contact_id']))
    {
        redirect($_SERVER['PHP_SELF']);
        die();
    }
    $bericht = mysqli_query($connection, "SELECT * FROM contact WHERE contact_id = ".$_GET['contact_id']." LIMIT 1") or die(mysqli_error());
    if (mysqli_num_rows($bericht) == 0)
    {
        die("Deze user bestaat niet !");
    }
    $bericht = mysqli_fetch_object($bericht);
    echo "Lezen van bericht van: <a class=\"edit\">".utf8_encode($bericht->contact_naam)."</a> met ID: <a class=\"edit\">".($bericht->contact_id)."</a><br /><br />";
    echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" enctype=\"multipart/form-data\">";
    echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"2\">";
    echo "<tr><td width=\"150\">User inlognaam:</td>";
    echo "<td>".utf8_encode($bericht->user_inlognaam)."</td></tr>";
    echo "<tr><td width=\"150\">User ID:</td>";
    echo "<td>".utf8_encode($bericht->user_id)."</td></tr>";
    echo "<tr><td width=\"150\">Email:</td>";
    //echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->usr_wachtwoord)."\" size=\"50\" name=\"usr_wachtwoord\" /></td></tr>";
    echo "<td>".utf8_encode($bericht->contact_email)."</td></tr>";    
    echo "<tr><td width=\"150\">Subject:</td>";
    echo "<td>".utf8_encode($bericht->contact_subject)."</td></tr>";  
    echo "<tr><td width=\"150\">Bericht:</td>";
    echo "<td>".utf8_encode($bericht->contact_bericht)."</td></tr>";  
    echo "<tr><td>&nbsp;</td>";
    echo "<td><input type=\"hidden\" name=\"contact_id\" value=\"".$bericht->contact_id."\" />";
    echo "<input type=\"submit\" name=\"submit_view_item\" value=\" Bekijken !\" /></td></tr>";
    echo "</table>";
    echo "</form>";
}
