<?php


function showTotaleBlog ()
{
   global $connection;

   if(isset($_GET['page']))
     {
      $_SESSION['page']=$_GET['page'];
    
      }
   else
      {
        if (!isset($_SESSION['page']))
           {
             $_SESSION['page']=0;
            }
       }
    $start=$_SESSION['page']*5;
    $prev = $_SESSION['page']-1;
    $next = $_SESSION['page']+1;
    $from = $_SESSION['page']*5+1;
    $to = $_SESSION['page'] * 5 + 5; 
       
  echo "<div id=\"blogLinks\">";     
  echo "<h2>";
  echo "Blog - Overzicht Pieter Spierenburg</h2>";

 $query1 = "SELECT * FROM `weblog` WHERE `blog_display`='y'";
 $result1 = mysqli_query($connection, $query1);
 
       if (mysqli_num_rows($result1)==0)   
                     {
                       die ("Je hebt geen gegevens tot je beschikking");
                     }
 while($row=mysqli_fetch_assoc($result1))
   {
    
    $title = $row['blog_title'];
    $blog_id = $row['blog_id'];
    $_GET['blog_id'] = $blog_id ;
    $_SESSION['blog_id'] = $_GET['blog_id']; 
    $date = $row['blog_postdate'];
    $datesplit = split('-',$date);
    $maanden = array('jan','feb','maart','april','mei','juni','juli','aug','sep','okt','nov','dec');
    $newDate = ($datesplit[2]*1)."-".$maanden[$datesplit[1]-1]."-".$datesplit[0];
    $tijdstip = $row['blog_tijdstip'];
    //$tijdstipsplit = split(':',$tijdtip);
    
    
    
    
    
    echo "<table border='1' cellspacing='0' cellpadding='0' width=70%>";
    echo "<tr><td width=60% div id=\"title\"><h3>".$row['blog_title']."</h3></td></div><td align='right'width=20% div id=\"blogid\">blog-id = ".$row['blog_id']."</td></div><td align='right' width=30% div id=\"date\">".$newDate."</td>"
            . "<td align='right' width=30% div id=\"tijdstip\"> om $tijdstip</td></tr></div>";
    echo "<tr><td width=100%  colspan=4 id=\"summary\">".$row['blog_summary']."</td></tr></div>";
    echo "<tr><td width=70%  rowspan=4 colspan=4 div id=\"content\">".$row['blog_content']."</td></tr></div>";
     
      $query2 = "SELECT * FROM `reactie` WHERE `reactie_display`='y' ";
      $result2 = mysqli_query($connection, $query2);
       if (mysqli_num_rows($result2)==0)   
                     {
                       die ("Je hebt geen gegevens tot je beschikking");
                     }
      while($row=mysqli_fetch_assoc($result2))
         { //hier wordt datum naar NL omgezet
           $date_r = $row['reactie_postdate'];
           $datesplit = split('-',$date_r);
           //$datesplit = split('&nbsp',$date_r);
           $tijdstip = $row['reactie_tijdstip'];
           $maanden = array('jan','feb','maart','april','mei','juni','juli','aug','sep','okt','nov','dec');
           $newDate_r = ($datesplit[2]*1)."-".$maanden[$datesplit[1]-1]."-".$datesplit[0]." om ".$tijdstip;
           $reactie = $row['reactie_content'];    
           $user_naam = $row['user_inlognaam'];
           $reactie_blog_id = $row['blog_id'];
           
        
              if($blog_id == $reactie_blog_id)
               {
                 //$_SESSION['blog_title'] = $row['blog_title'];
                 echo "<table border='1' cellspacing='0' cellpadding='0' width=70%>";
                 echo "<tr><td id=\"react\"  width=70%><h5>Reactie:".$user_naam."</h5></td><td id=\"newdate\" align='right'width=30%>".$newDate_r."</td></tr>";
                 echo "<tr><td id=\"reactie\" width=70%  rowspan=4 colspan=4>".$reactie."</td></div></tr>";
                 echo "</table>"; 
               }
          }

    echo "</table>";
    echo "<a href=reactie.php?blog_id=".$blog_id." > Schrijf een reactie</a>)";
    echo "<br /><br />";
   // echo "<hr >";
 }

    echo "<table>";
    echo "<tr><td colspan='3'></td></tr>";
    echo "<tr><td>".($prev>=0?"<a href=blog.php?page=". $prev."> prev</a>":"prev")."</td>";
    echo "<td>$from..$to</td>";
    echo "<td>".(mysqli_num_rows($result1)>4?"<a href=blog.php?page=".$next."> next</a>":"next")."</td>"; 
    echo "</tr>";
    echo "</table>";
  echo "</div>"; 
  
  
  echo "<br>";
  
 //google adsense advertentie ruimte
 echo "<div id=\"kolomRechts\">";
 echo "Google advertentie ruimte";
       echo "<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>       
<!-- advertentie-ruimte -->
<ins class=\"adsbygoogle\"
     style=\"display:block\"
     data-ad-client=\"ca-pub-8569192749694084\"
     data-ad-slot=\"3299327059\"
     data-ad-format=\"auto\"></ins>
 <script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>";
 echo "Einde Google advertentie ruimte";       
 echo "</div>";//einde code advertentie ruimte
    
  echo "mysqli_close($connection)";    
}

  
function showFormReactie ($blog_id="",$reactie="",$postdatereactie="",$user_inlognaam="")
{//reactieformulier tonen
    global $connection;

    if(isSet($_POST['reactie']))//er is een reactie geschreven
    {
 
        $_SESSION['blog_id'] = $_GET['blog_id'];
        $blog_id = $_SESSION['blog_id'];
        $user_inlognaam = $_SESSION['loginnaam'];
        $reactie = $_POST['reactie'];
        $_SESSION['reactie'] = $reactie;
        
     }   
    if(!isSet($_POST['reactie_postdate']))//als de datum niet is ingevuld,
     {
        date_default_timezone_set("Europe/Amsterdam");
        $reactietijdstip = date("H:i:s");
        $_SESSION['reactietijdstip'] = $reactietijdstip;
        $postdatereactie = date("Y-m-d");//." &nbsp ".date("H:i")." uur";//wordt dat hier gedaan
        $_SESSION['postdatereactie'] = $postdatereactie; 
      }
    
    $query1 = "SELECT * FROM `weblog` WHERE `blog_id`='".$_GET['blog_id']."'";//haal uit de tabel weblog,
    $result1 = mysqli_query($connection, $query1);
 
    if (mysqli_num_rows($result1)==0)   
                     {
                       die ("Je hebt geen gegevens tot je beschikking");
                     }
    while($row=mysqli_fetch_assoc($result1))
       {
        $title = $row['blog_title']; // de blog-titel op, waar de reactie betrekking op heeft
       } 
     
    echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>";
    echo "<br /><h5>Blog-id = ".$_GET['blog_id']."<br />";
    echo "Blog-Titel: '".$title."'</h5>";
    echo "Blog-datum: ".$postdatereactie." om ".$reactietijdstip." uur</h5>";
    echo "<input type='hidden' name='blog_id' value='".$_GET['blog_id']."'><br />";//wordt als POST-variabele gebruikt
    //bij de INSERT in de reactie-tabel in de functie 'handleFormReactie'
    echo "<h4>Beste ".$_SESSION['loginnaam']." ,hieronder kun je je reactie plaatsen</h4>";
    echo "<input type='hidden' name='reactie_postdate' value='".$postdatereactie."'><br/>";
    echo "<input type='hidden' name='reactie_tijdstip' value='".$reactietijdstip."'>";
    echo "<textarea name=\"reactie\" cols=\"78\" rows=\"6\" value='".$reactie."' id=\"reactie\"></textarea><br/>";   
    echo "<input type='submit' name='reactiesubmit' value='Reactie Posten'>";
    echo "</form>";
}

function handleFormReactie($blog_id,$loginnaam)
{ 
    global $connection;

    if(isSet($_POST['reactie'])&& $_POST['reactie']!=="")
    { 
        
        $_SESSION['postdatereactie'] = $_POST['reactie_postdate'];
        $_SESSION['reactie'] = $_POST['reactie'];
          
       mysqli_query($connection, "INSERT INTO `reactie` (`blog_id`, `user_inlognaam`, `reactie_content`, `reactie_postdate`, `reactie_tijdstip`) 
                   VALUES('".$_POST['blog_id']."', '".$loginnaam."' , '".$_SESSION['reactie']."' , '".$_SESSION['postdatereactie']."', '".$_SESSION['reactietijdstip']."')") 
                 or die(mysqli_error());
    //Door de java script-code hieronder wordt na het toevoegen van een reactie de totale blog inclusief de 
    //zojuist toegevoegde reactie,weer getoond.
       
        echo "<script type=\"text/javascript\">
           window.location = \"".$GLOBALS['path']."/application/modules/psinfoportal/blog.php\"
      </script>"; 
            
       
    }
    echo "U heeft geen reactie geplaats !";
       /*echo "<script type=\"text/javascript\">
           window.location = \"".$GLOBALS['path']."/application/modules/psinfoportal/blog.php\"
          </script>"; */
            
}

