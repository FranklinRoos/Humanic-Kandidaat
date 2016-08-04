 <?php
session_start();
include ("../../config/config.php");
include ("../../config/connect.php");
include ("include/userBlogFunctions.php");
include ("include/onlineFunctions.php");
include("../../config/default_functions.php");
include ("../FCKeditor/fckeditor.php");
//maak connectie met je eigen database
if(!isSet($_SESSION['blad']))
{
    $_SESSION['blad']='blog_page';
    $_SESSION['blog_page']=0;
}
if($_SESSION['blad']!=='blog_page')    
{
  $_SESSION['blad']='blog_page';
  $_SESSION['blog_page']=0;
}
 $pageNavId=13;
 fHeader($pageNavId);//actief=$pageNavId);
 
 if(!isSet($_SESSION["user_authorisatie"]))
     {
       navigatie($pageNavId);      
     }
 
elseif(isSet($_SESSION["user_authorisatie"])&& $_SESSION["user_authorisatie"]=="admin" OR $_SESSION["user_authorisatie"]=="ptr")
         {
           navigatieA($pageNavId);
         }

 
/*
if (!isset($_SESSION["loginnaam"]))
   {
    //echo "<br /><br /><br /><h2 align=center>Dit is de website van en over Pieter Spierenburg</h2>";
    //echo "<br /><h3>U dient eerst<a href=\"login.php\"> ingelogd</a> te zijn</h3>";
    
    echo "<br /><br /><br /><h2 align=center>Dit is de website van en over Pieter Spierenburg</h2>";
    echo "<br /><h3>U dient eerst<a href=\"login.php\"> ingelogd</a> te zijn om de blog te kunnen gebruiken</h3><br>";
    echo "<h4>Heeft u zich nog niet geregistreerd?<br/>";
    echo "Dat kan <a href=\"register.php\">hier.</a></h4>";

    fFooter($pageNavId);
} 
 else   
  
{ */
     
     //showTotaleBlog ();
     
    
   if(isset($_GET['blog_page']))
     {
      $_SESSION['blog_page']=$_GET['blog_page'];
    
      }
   else
    {
        if (!isset($_SESSION['blog_page']))
         {
           $_SESSION['blog_page']=0;
         }
     }
    $qpp = 5;
    $start=$_SESSION['blog_page']*$qpp;
    $prev = $_SESSION['blog_page']-1;
    $next = $_SESSION['blog_page']+1;
    $from = $_SESSION['blog_page']*$qpp+1;
    $to = $_SESSION['blog_page'] * $qpp + $qpp;  
              
   /* $start=$_SESSION['blog_page']*5;
    $prev = $_SESSION['blog_page']-1;
    $next = $_SESSION['blog_page']+1;
    $from = $_SESSION['blog_page']*5+1;
    $to = $_SESSION['blog_page'] * 5 + 5; */ 
       
  echo "<div id=\"blogLinks\">";     
  echo "<h2>";
  echo "Blog - Overzicht Pieter Spierenburg</h2>";
$blogs = mysqli_query($connection, "SELECT * FROM `weblog` WHERE `blog_display`='y'")or die(mysqli_error());
$count_blogs = mysqli_num_rows($blogs ); 
  
 $query1 = "SELECT * FROM `weblog` WHERE `blog_display`='y'  ORDER BY `blog_id` DESC LIMIT $start,5 ";
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
     
    
    echo "<table border='1' cellspacing='0' cellpadding='0' width=100%>";
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
           $tijdstip = $row['reactie_tijdstip'];
           $maanden = array('jan','feb','maart','april','mei','juni','juli','aug','sep','okt','nov','dec');
           $newDate_r = ($datesplit[2]*1)."-".$maanden[$datesplit[1]-1]."-".$datesplit[0]." om ".$tijdstip;
           $reactie = $row['reactie_content'];    
           $user_naam = $row['user_inlognaam'];
           $reactie_blog_id = $row['blog_id'];
                
              if($blog_id == $reactie_blog_id)
               {
                 //$_SESSION['blog_title'] = $row['blog_title'];
                 echo "<table id='reacties' border='1' cellspacing='0' cellpadding='0' width=100%>";
                 echo "<tr><td width=70%><h5>Response ".$user_naam.":</h5></td><td align='right'width=30%>".$newDate_r."</td></tr>";
                 echo "<tr><td id=\"reactie\" width=70%  rowspan=4 colspan=4>".$reactie."</td></div></tr>";
                 echo "</table>"; 
               }
          }

    echo "</table>";
    echo "<a href=reactie.php?blog_id=".$blog_id." >(Schrijf een reactie)</a>";
    echo "<br /><br />";
 }
    global $path;
    echo "<table>";
    echo "<tr><td colspan='3'></td>";
    //echo "<tr><td>".($prev>=0?"<a href=blog.php?page=".$prev. "> prev&nbsp;</a>":"prev&nbsp;")."</td>";
    //echo "<td>$from...$to</td>";
    //echo "<td>".(mysqli_num_rows($result1)>5?"<a href=blog.php?page=" .$next.">&nbsp;next</a>":"&nbsp;next")."</td>";
    
    echo "<tr><td>".($prev>=0?"<a href=blog.php?blog_page=".$prev. "> prev&nbsp;</a>":"prev&nbsp;")."</td>";
    echo "<td>$from...$to</td>";
    echo "<td>".(($count_blogs - $to)>0?"<a href=blog.php?blog_page=" .$next.">&nbsp;next</a>":"&nbsp;next")."</td>";
    echo "</tr>";
    echo "</table>";
 
  echo "</div>"; 
  
  echo "<br>";
  
 //google adsense advertentie ruimte
 echo "<div id=\"kolomRechts\">";
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
 echo "</div>";//einde code advertentie ruimte
     

fFooter($pageNavId);
//}



     