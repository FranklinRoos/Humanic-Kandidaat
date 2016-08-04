<?php
function fHeader($pageNavId="1")
{
    global $connection;
    
    echo "<!DOCTYPE html>";
    echo "<html lang=\"en\">";
    echo "<head>";
    echo "<link href='https://fonts.googleapis.com/css?family=Lateef' rel='stylesheet' type='text/css'>";
    //echo "<link rel=\"stylesheet\" href=\"..\..\assets\css\style.css\" type=\"text/css\" />";
    echo "<div id =\"header\" role=\"banner\">";
    echo "<meta charset=\"utf-8\">";
    echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";

    //<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    // haal de gegevens voor de desbetreffende pagina uit de database
    $sql = mysqli_query($connection, "SELECT * FROM `pages` where `page_nav_id`=$pageNavId and `page_show` ='y'")
                or die ("Je hebt geen gegevens tot je beschikking");
    if (mysqli_num_rows($sql)==0)   
    {
        die ("Je hebt geen gegevens tot je beschikking");
    }
    while ($content = mysqli_fetch_assoc($sql)) 
    {
        echo "<meta name=\"description\" content=\"".$content["page_description"]."\">";
        echo "<meta name=\"keywords\" content=\"".$content["page_keywords"]."\">";
    }
    echo "<meta name=\"author\" content=\"Franklin Roos, Thijs v Hout,Bart Kijlstra, Ron de Wit & Sellahatin\">";
    echo "<title>Humanic IC</title>";
    //<!-- Bootstrap -->
    //echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['path']."assets/css/bootstrap.min.css\" type=\"text/css\">";
    echo "<link rel=\"stylesheet\" href=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\">";
    //<!-- Optional theme -->
   // echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['path']."assets/css/bootstrap-theme.min.css\" type=\"text/css\">";
    //<!-- My theme -->
    echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['path']."assets/css/dropmenu.css\" type=\"text/css\"/>";
    echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['path']."assets/css/slider.css\" type=\"text/css\"/>";
    //echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['path']."assets/css/slider.less\" type=\"text/css\"/>";    
      
    echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['path']."assets/css/fuikweb.css\" type=\"text/css\"/>";
    echo "<link rel=\"stylesheet\" href=\"".$GLOBALS['path']."assets/css/style.css\" type=\"text/css\"/>";
    echo "<script src=\"https://code.jquery.com/jquery-2.2.4.min.js\"  ></script>";
    echo  "<script src=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js\"></script>";
    echo "<script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.1.1/bootstrap-slider.js\"></script>";
    echo "<script src=\"".$GLOBALS['path']."assets/js/slider.js\" ></script>";
    
    
    $path=$GLOBALS['path'];
    //$path=substr_replace($path ,"",-1);
    echo "<script src=\"$path/jquery-1.11.3.min.js\"></script>
    <script type=\"text/javascript\">
    <!--
    function inofuitLoggen(idinuit) {
    location.replace('".$path."/application/modules/humanic-portal/login.php?idinuit='+idinuit);}
    -->
    </script>";
    echo "<script type=\"text/javascript\" src=\"assets/flash-flowplayer/flowplayer-3.2.13.min.js\"></script> 
    <script type=\"text/javascript\" src=\"assets/flash-flowplayer/flowplayer.ipad-3.2.13.min.js\"></script>";
    echo "<style type=\text/css>";
    echo "#ps01 { width: 100%; height: 100%; position: absolute; top: 0; left: 0; }";
    echo ".videovak { position: relative; width: 100%; height: 0; padding-bottom: 62.5%; }";
    echo "</style>";
    echo "</head>";
    
    echo "<body>";
    echo "<div id=\"contentwrapper\">";
    echo "<br><br><br><br>";

    echo "<a href=\"".$GLOBALS['path']."index.php?taal_id=nl\">";
   echo "<img alt=\"logo\" width=\"300\" style=\"margin: -30px 0px 5px 0px;\" src=\"".$GLOBALS['path']."assets/images-humanic/header.png\">";
    echo "</a>";
    
    echo "<div class=\"navbar-form pull-right\">";
    //checken op inloggen en de knop in/uitloggen tonen
    if (isSet($_SESSION["loginnaam"])) 
    {
         $date = $_SESSION['user_sinds'];//(yyyy-mm-dd)
         $datesplit = explode('-',$date);
         $maanden = array('jan','feb','maart','april','mei','juni','juli','aug','sep','okt','nov','dec');
         $datum = ($datesplit[2]*1)."-".$maanden[$datesplit[1]-1]."-".$datesplit[0];//de index bij $maanden[$datesplit[1] wordt met 1 verminderd omdat de array '$maanden' met 0 begint
         

        echo "<input type =\"button\" id=\"login\" onclick=\"inofuitLoggen(0)\" value=\"Uitloggen\" class=\"btn\"></button>";
        echo "</div><div class=\"navbar-form pull-right\">";
        echo "<div id=\"inlognaam\"><a class=\"inlognm\">";
        echo "".ucfirst($_SESSION["loginnaam"])."</a><br/>";      
        echo "<a class=\"regsinds\">Registreerd sinds: ".$datum."</a></div></div>" ;
     } 
     else
    {
        echo "<input type =\"button\" id=\"login\" onclick=\"inofuitLoggen(1)\" value=\"Inloggen\" class=\"btn\"></button></div>";
    }
    echo "</form>"; 
         echo "<div class=\"push\"></div>";
    //echo "</div>";
    echo "</div>";
}

function fFooter($pageNavId="1")
{
    global $connection;
    
    echo "<div id=\"footer\">";
    echo "<footer class=\"footer\">";
    //echo "<div class=\"container\">";
    echo "<p class=\"text-muted\">";      
    echo "<ul class=\"nav nav-pills\">";
    //toegevoegd op zat 9 juli 2016
    global $imagepath;
    //echo "<div><img width=\"250\" height=\"90\" src=\"$imagepath/header2.png\" style=\" margin:30px;\"  class=\"mbr-contacts_img mbr-contacts_img--left\" />";
    //echo "</div>";
    $sql = mysqli_query($connection, "SELECT * FROM `nav` WHERE `nav_place` = 'footer' AND  `nav_show`= 'y' ");
    //echo "<div><img width=\"250\" height=\"90\" src=\"$imagepath/header2.png\" style=\" margin:30px;\"  class=\"mbr-contacts_img mbr-contacts_img--left\" /></div>";
    
    if (mysqli_num_rows($sql)==0)  
    {
        die ("Je hebt geen gegevens nav tot je beschikking");
    }     
    while ($row = mysqli_fetch_assoc($sql))
    {       
        if ($row['nav_id']==$pageNavId)
        {
            echo "<li role=\"presentation\" class=\"active\"><a href=\"".$GLOBALS['path'].$row['nav_url']."\">".$row['nav_naam']."</a></li>";
        } else
        {
            echo "<li role=\"presentation\"><a href=\"".$GLOBALS['path'].$row['nav_url']."\">".$row['nav_naam']."</a></li>";
        }
    }
    echo "<div class=\"merk\">Copyright (c) 2016 Humanic Development BV</div>";
    echo "</ul></p>";
    //echo "</div>";
    echo "</footer>";
    echo "
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src=\"assets/js/jquery.min.js\"></script>
    <!-- Latest compiled and minified JavaScript -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src=\"assets/js/bootstrap.min.js\"></script>
    </body>
    </html>";
    echo "</div>";
}

function footer()
{
    //<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    echo "<script src=\"assets/js/jquery.min.js\"></script>";
    //<!-- Latest compiled and minified JavaScript -->
    //<!-- Include all compiled plugins (below), or include individual files as needed -->
    echo "<script src=\"assets/js/bootstrap.min.js\"></script>";
    echo "</body>";
    echo "</html>";
}

function navigatie($pageNavId="1")
{
    global $connection;
    
    //echo "<nav class=\"navbar navbar-inverse navbar-fixed-top\">";
    //echo "<nav class=\"navbar navbar-inverse navbar-fixed-top\">";
    echo "<nav class=\"navbar navbar-inverse \">";
    echo "<div class=\"container\">";
    echo "<button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">";
    echo "<span class=\"sr-only\">Toggle navigation</span>";
    echo "<span class=\"icon-bar\"></span>";
    echo "<span class=\"icon-bar\"></span>";
    echo "<span class=\"icon-bar\"></span>";
    echo "</button>";
    echo "<a class=\"navbar-brand\" id=\"brand\" href=\"".$GLOBALS['path']."index.php\">";
    echo "<img src=\"".$GLOBALS['path']."assets/images/header2.png\" alt=\"humanic-logo\" width=\"140\" height=\"50\" </a>";
    echo "</a>";
    echo "<ul class=\"nav navbar-nav\">";
    // selecteer alles (voor de navigatie) voor de header en show=y 
      if(!isSet($_SESSION["user_authorisatie"]) OR $_SESSION["user_authorisatie"] == 'usr'){
        $sql = mysqli_query($connection, "SELECT * FROM `nav` where `nav_place`='header' AND `nav_auth`='usr' AND `nav_taal`='nl' AND `nav_show`='y' order by `volgorde` ");
     }
     else {
         $sql = mysqli_query($connection, "SELECT * FROM `nav` where `nav_place`='header' AND `nav_auth`='admin' AND `nav_taal`='nl' AND `nav_show`='y' order by `volgorde` ");
     }
     
    // aanmaken array voor gebruik in function
    while($ln = mysqli_fetch_assoc($sql))
    {
    $menu_items[] = (object) array(
    'id'   =>$ln['nav_id'] , 
    'name' =>$ln['nav_naam'],
    'url'  =>$ln['nav_url'],
    'place'=>$ln['nav_place'],
    'show' =>$ln['nav_show'],
    'parent_id'=>$ln['nav_parent_id']
    );
    }

    global $menuItems;
    global $parentMenuIds;
    //aanmaken array van parent_id's voor checken op children
    foreach($menu_items as $parentId)
    {
      $parentMenuIds[] = $parentId->parent_id;
    }
    // menu items toewijzen aan de global array voor gebruik in de functie
    $menuItems = $menu_items;
    // menu items ophalen
    generate_menu(0);

    echo "</li>";
    echo "</ul>";
    echo "</div>";
    echo "</nav>";
    
}



function navigatieA($pageNavId="1")
{
    global $connection;
    
    //echo "<nav class=\"navbar navbar-inverse navbar-fixed-top\">";
    //echo "<nav class=\"navbar navbar-inverse navbar-fixed-top\">";
    echo "<nav class=\"navbar navbar-inverse \">";
    echo "<div class=\"container\">";
    echo "<button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">";
    echo "<span class=\"sr-only\">Toggle navigation</span>";
    echo "<span class=\"icon-bar\"></span>";
    echo "<span class=\"icon-bar\"></span>";
    echo "<span class=\"icon-bar\"></span>";
    echo "</button>";
    echo "<a class=\"navbar-brand\"id=\"brand\"  href=\"".$GLOBALS['path']."index.php\">";
    echo "<img src=\"".$GLOBALS['path']."assets/images/header2.png\" alt=\"humanic-logo\" width=\"80\" height=\"50\"</a>";
    echo "<ul class=\"nav navbar-nav\">";
    // selecteer alles (voor de navigatie) voor de header en show=y 
    $sql = mysqli_query($connection, "SELECT * FROM `nav` where `nav_place`='header'  and `nav_show`='y' and `nav_auth`='admin' order by `volgorde` ");

    // aanmaken array voor gebruik in function
    while($ln = mysqli_fetch_assoc($sql))
    {
    $menu_items[] = (object) array(
    'id'   =>$ln['nav_id'] , 
    'name' =>$ln['nav_naam'],
    'url'  =>$ln['nav_url'],
    'place'=>$ln['nav_place'],
    'show' =>$ln['nav_show'],
    'parent_id'=>$ln['nav_parent_id']
    );
    }

    global $menuItems;
    global $parentMenuIds;
    //aanmaken array van parent_id's voor checken op children
    foreach($menu_items as $parentId)
    {
      $parentMenuIds[] = $parentId->parent_id;
    }
    // menu items toewijzen aan de global array voor gebruik in de functie
    $menuItems = $menu_items;
    // menu items ophalen
    generate_menu(0);

    echo "</li>";
    echo "</ul>";
    echo "</div>";
    echo "</nav>";
   

}


function generate_menu($parent)
{
    //binnen eigen function (voor children) oproepbare function voor het weergeven van het menu incl. children
    $has_childs = false;

    //voorkomt 'ul' indien er geen subcategorieen weer te geven zijn
    global $pageNavId;
    global $menuItems;
    global $parentMenuIds;
    //gebruik global array variable in plaat van local om het geheugen minder te belasten
    foreach($menuItems as $key => $value)
    {
        if ($value->parent_id == $parent) 
        {    
            //Indien het eerste child '<ul>'
            if ($has_childs === false)
            {
                //blokkeer '<ul>' tegen vaker gebruik  
                $has_childs = true;
                if($parent != 0)
                {
                    echo '<ul class="dropdown-menu">';
                }
            }
            if($value->parent_id == 0 && in_array($value->id, $parentMenuIds))
            {
                $style="";
                $stylea="";
                if ($value->id==$pageNavId)
                {
                    $style="style=\"background-image: -webkit-linear-gradient(top, #080808 0, #0f0f0f 100%);
                    background-image: -o-linear-gradient(top, #080808 0, #0f0f0f 100%);
                    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #080808), to(#0f0f0f));
                    background-image: linear-gradient(to bottom, #080808 0, #0f0f0f 100%);
                    background-repeat: repeat-x;
                    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff080808', endColorstr='#ff0f0f0f', GradientType=0);
                    -webkit-box-shadow: inset 0 3px 9px rgba(0,0,0,0.25);
                    box-shadow: inset 0 3px 9px rgba(0,0,0,0.25);\"";
                    $stylea="style=\"color: #fff;background-color: #080808;\"";
                }
                // controle op gehele url (externe website)
                if (substr($value->url, 0, 4)!=="http")
                {
                    echo '<li class="dropdown"'.$style.'><a class="dropdown-toggle"'.$stylea.' href="'.$GLOBALS['path'].$value->url.'" role="button" aria-haspopup="true" aria-expanded="false">' . $value->name . '<span class="caret"></span></a>';
                } else
                {
                    echo '<li class="dropdown"'.$style.'><a class="dropdown-toggle"'.$stylea.' href="'.$value->url.'" TARGET="_blank" role="button" aria-haspopup="true" aria-expanded="false">' . $value->name . '<span class="caret"></span></a>';
                }
            }
            else if($value->parent_id != 0 && in_array($value->id, $parentMenuIds))
            {
                if (substr($value->url, 0, 4)!=="http")
                {
                    echo '<li class="dropdown-submenu"><a href="'.$GLOBALS['path'].$value->url.'">' . $value->name . '</a>';
                } else
                {
                    echo '<li class="dropdown-submenu"><a href="'.$value->url.'" TARGET="_blank">' . $value->name . '</a>';
                }
            }
            else
            {
                if ($value->id==$pageNavId)
                {
                    if (substr($value->url, 0, 4)!=="http")
                    {
                        echo '<li class="active"><a href="'.$GLOBALS['path'].$value->url.'">' . $value->name . '</a>';
                    } else
                    {
                        echo '<li class="active"><a href="'.$value->url.'" TARGET="_blank">' . $value->name . '</a>';
 
                    }
                } else
                {
                    if (substr($value->url, 0, 4)!=="http")
                    {
                        echo '<li><a href="'.$GLOBALS['path'].$value->url.'">' . $value->name . '</a>';
                    } else
                    {
                        echo '<li><a href="'.$value->url.'" TARGET="_blank">' . $value->name . '</a>';
                    }
                }
            }
            //roep de function opnieuw aan voor de children van deze parent
            generate_menu($value->id);
            echo '</li>';
        }
    }
    if ($has_childs === true) echo '</ul>';
}



function navigatieAdmin($pageNavId="1")
{
    global $connection;
    
    echo "<div class=\"navbar navbar-fixed-top\">";
    echo "<ul class=\"nav nav-tabs\" style=\"background-color: #FFF;\">";
    // haal uit database gegevens
    // verwerk het in de list-item
    $sql = mysqli_query($connection, "SELECT * FROM `navadmin` WHERE  `navadmin_show` = 'y'  order by `navadmin_volgorde`");
    if (mysqli_num_rows($sql)==0)  
    {
        die ("Je hebt geen gegevens nav tot je beschikking,ga fietsen");
    } 
    while ($row = mysqli_fetch_assoc($sql))
    {
        if ($row['navadmin_id']==$pageNavId)
        {
            echo "<li role=\"presentation\" class=\"active\"><a href=\"".$GLOBALS['path'].$row['navadmin_url']."\">".$row['navadmin_naam']."</a></li>";
        } else
        {
            echo "<li role=\"presentation\"><a href=\"".$GLOBALS['path'].$row['navadmin_url']."\">".$row['navadmin_naam']."</a></li>";
        }
    }
    echo "</ul>";
    echo "</div>";
}

function navigatiePtr($pageNavId="1")
{
    global $connection;
    
    echo "<div class=\"navbar navbar-fixed-top\">";
    echo "<ul class=\"nav nav-tabs\" style=\"background-color: #FFF;\">";
    // haal uit database gegevens
    // verwerk het in de list-item
    $sql = mysqli_query($connection, "SELECT * FROM `navadmin` WHERE  `navadmin_show` = 'y' and `navadmin_auth` = 'ptr' order by `navadmin_volgorde`");
    if (mysqli_num_rows($sql)==0)  
    {
        die ("Je hebt geen gegevens nav tot je beschikking,ga fietsen");
    } 
    while ($row = mysqli_fetch_assoc($sql))
    {
        if ($row['navadmin_id']==$pageNavId)
        {
            echo "<li role=\"presentation\" class=\"active\"><a href=\"".$GLOBALS['path'].$row['navadmin_url']."\">".$row['navadmin_naam']."</a></li>";
        } else
        {
            echo "<li role=\"presentation\"><a href=\"".$GLOBALS['path'].$row['navadmin_url']."\">".$row['navadmin_naam']."</a></li>";
        }
    }
    echo "</ul>";
    echo "</div>";
}





function loginAdmin()
{
        echo "<h1>Login</h1>";
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post' >";
        echo "Geef uw login naam:";
        echo "<input type='text' name='login'><br>";
        echo "Geef uw wachtwoord:";
        echo "<input type='password' name='passwd'><br>";
        echo "<input type='submit' name='submit' value='Login'>";
        echo "</form>";  
}

function handleFormAdmin()
{
    if (!isset($tellerInloggen))
    {
        $tellerInloggen=0;
    }    
    if (!isset($_COOKIE['laatsteKeer']))
    {
        $_COOKIE['laatsteKeer']= date("j, M, Y");
    }
    if ($_POST['login']!="")
    {   // vraag het correcte login op
        if ($_POST['passwd']!="")
        {   // vraag het correcte wachtwoord op
            $correct_passwd = trim(getPasswordAdmin($_POST['login']));
            if (md5(trim($_POST['passwd']))==trim($correct_passwd))
            {
                echo "<b>U bent ingelogd!</b><br>";
                echo "Ga verder door een keuze te maken uit de navigatie";
                $_SESSION["loginnaam"] = $_POST["login"];
                $_SESSION["password"] = md5($_POST["passwd"]);
            } else
            {  
                echo "<b>Het systeem kon u niet inloggen, probeer het nogmaals!</b><br>";
                $tellerInloggen++;
                if ($tellerInloggen<4)
                {
                    loginAdmin();
                }else
                {
                    echo "<b>Volgens geruchten mag u maar 3 keer inloggen!</b><br>";
                }
            }
        } else
        {  
            echo "<b>U moet wel een echt wachtwoord invullen!</b><br>";
            loginAdmin();
        } 
    }   
}
    
function getPasswordAdmin($usernaam)
{
    global $connection;
    
    $pass = "";
    $sql = mysqli_query($connection, "SELECT * FROM `user`");
    if (mysqli_num_rows($sql)==0)  
    {
        die ("Je heb geen gegevens tot je beschikking");
    }
    while ($row = mysqli_fetch_assoc($sql)) 
    {
        if ($usernaam == $row['user_inlognaam'])
        { 
            $pass = $row['user_wachtwoord'];
        }
    }
    return $pass;
}
 
?>
