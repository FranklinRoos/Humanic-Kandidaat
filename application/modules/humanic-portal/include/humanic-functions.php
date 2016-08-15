<?php
global $connection;
    
function showPaswVergForm()// deze functie gebruik ik (nog) niet , is een test.
    {
        echo "<h1>Stel je wachtwoord opnieuw in</h1>";
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>";
        echo "<table>";
        echo "<tr><td>We hebben uw email-adres nodig om uw wachtwoord opnieuw in te stellen:</td>";
        echo "<td><input type='text' name='emailuser' value='email'></td></tr>";
        echo "</table>";
        echo "<input type='submit' name='submit' value='wachtwoord opnieuw instellen'>";
        echo "</form><br/>";

    }

 
/* @var $_POST type */
function handlePaswVergForm($email) // deze functie gebruik ik (nog) niet , is een test.
{
  global $connection;

// Als het gaat om bevestigen van het mailtje
if(getUseremail($email) === true)//het email-adres komt voor in de db
{
    $activatiecode = sqlsafe($_GET['code']);
    $select_code = "SELECT * FROM `user` WHERE `vergeetcode` = '".$activatiecode."'";
    $query_code = mysqli_query($connection, $select_code) or die (mysqli_error());
    $show_code = mysqli_fetch_assoc($query_code);

    if(mysqli_num_rows($query_code) == "0")
    {
        echo "<div style=\"color:red;\">U heeft een verkeerde activatiecode ingevuld, of uw heeft reeds een bevestiging gedaan!</div>";
    }
    else
    {
        // Email selecteren
        $res = mysqli_query($connection, "SELECT * FROM `user` WHERE `vergeetcode` = '".$activatiecode."'");
        $show = mysqli_fetch_assoc($res);
                    
        // Password maken
        $pass = randomcode(10);
                    
        // Melding geven
        echo "Er is een mail met een nieuw wachtwoord gestuurd.";
                    
        // Database updaten
        mysqli_query($connection, "UPDATE `user` SET `vergeetcode` = '', `user_wachtwoord` = '".md5($pass)."' WHERE `vergeetcode` = '".$activatiecode."'");
                                        
        // Mail versturen
        //$headers   = array();
        $eigen_naam = 'Humanic IC';
        $eigen_mail = 'frankieboy37@hotmail.com';
        $aan = $show['user_email'];
        $onderwerp = "Nieuw wachtwoord";
        $bericht = "Beste '".$show['user-inlognaam']."',<br /><br />Via de website http://humanicdevelopment.com/index.html#content5-12 heeft u een nieuw wachtwoord aangevraagd.<br /><br /><strong>U kunt nu inloggen met het wachtwoord:</strong> ".$pass."<br /><br />Met vriendelijke groet,<br /><br />".$eigen_naam;
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        $headers .= "From: ".$eigen_naam." <".$eigen_mail.">\r\n";
        //$headers[] = "X-Mailer: PHP/".phpversion();
        mail($aan, $onderwerp, $bericht, $headers); 
    }
}
else
{

    if(($_SERVER['REQUEST_METHOD'] == "POST") && ($_POST['vergeten'])) 
    {
        $que = mysqli_query($connection,"SELECT * FROM `".$ledentabel."` WHERE emailadres = '".sqlsafe($_POST['emailadres'])."'");
                    
        if(mysqli_num_rows($que) == 0)
        {
            echo "<p>Het ingevuld emailadres is niet geldig of staat niet in de database!</p>";
        }
        else
        {
            // Code
            $activatiecode = randomcode(10);
                        
            // Melding
            echo "<p>Er is een bevestigingsmail naar je e-mailadres gestuurd.</p>";
                    
            // Database updaten dus code inserten
            mysqli_query($connection, "UPDATE `".$ledentabel."` SET `vergeetcode` = '".$activatiecode."' WHERE `emailadres` = '".sqlsafe($_POST['emailadres'])."'");
                    
            // Mail versturen
            $aan = sqlsafe($_POST['emailadres']);
            $onderwerp = "Wachtwoord vergeten";
            $bericht = "Beste,<br /><br />Via de website ".$eigen_site." is aangegeven dat u uw wachtwoord vergeten bent.<br /><br />Wanneer dit het geval is, dient u op onderstaande link te klikken. Wanneer dit niet zo is, kunt u deze mail als niet verzonden beschouwen.<br /><br />Link: <a href=\"".$eigen_url."addons/wachtwoordvergeten.php?actie=bevestigen&code=".$activatiecode."\">".$eigen_url."addons/wachtwoordvergeten.php?actie=bevestigen&code=".$activatiecode."</a><br /><br />Met vriendelijke groet,<br /><br />".$eigen_naam;
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
            $headers .= "From: ".$eigen_naam." <".$eigen_mail.">\r\n";
            mail($aan, $onderwerp, $bericht, $headers); 
        }
    }
    else
    {
        echo "<p>Vul hieronder uw emailadres in. Er zal een link naar je emailadres gestuurd worden. Wanneer u hier op klikt wordt er een nieuw wachtwoord aangemaakt.</p><br />";
        echo "<p><form method=\"post\" action=\"\">E-mailadres:&nbsp;&nbsp;<input type=\"text\" name=\"emailadres\" /><br /><br /><input type=\"submit\" name=\"vergeten\" value=\"Verstuur\" /></form></p>";                
    }
}
}   
    
function showForm()
    {
        echo "<section id=\"loginblok\">";
         echo "<h3>Inloggen</h3>";
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>";
        echo "<table id=\"login\">";
        echo "<tr><td>Geef uw login naam:</td>";
        echo "<td><input type='text' name='login'></td></tr>";
        echo "<tr><td>&nbsp</td></tr>";
        echo "<tr id=\"loginnaam\" ><td>Geef uw wachtwoord:</td>";       
        echo "<td><input type='password' name='passwd'></td></tr>";
        echo "</table>";
        echo "<input type='submit' name='submit' value='Login'>";
        echo "</form><br/>";
        echo "</section>";
        //echo "<a href=\"nwPasw.php\">Bent u uw wachtwoord vergeten ?</a>";
    }


function handleForm()
    {
        global $connection;
        global $pageNavId;
        if (!isset($_SESSION["tellerInloggen"]))
        {
            $_SESSION["tellerInloggen"]=0;
        }
       /* if (!isSet($_COOKIE['laatsteKeer']))//als de cookoie niet bestaat,wordt die nu gemaakt
        {
            $m_int=date("n")-1;
            $m_name=array("januari","februari","maart","april","mei","juni","juli","augustus","september","oktober","november","december");
            $month=$m_name[$m_int];
            $datum=date("d ").$month.date(" Y")." om ".date("H:i")." uur";
            $_COOKIE['laatsteKeer']= $datum;
        }*/
        if ($_POST['login']!="")
        {   // vraag het correcte login op
           if ($_POST['passwd']!="")
            {   // vraag het correcte wachtwoord en de authorisatie op 
                
                $auth = getAuthorisatie(strtolower($_POST['login']));//de auhtorisatie wordt hier opgevraagd
                if($auth != 'admin')
                    {
                        echo "<script type=\"text/javascript\">
                                    window.location = \"".$GLOBALS['path']."/application/modules/admin/indexAdmin.php\"
                                </script>";                   
                    
                    }
                else
                {
                            $correct_passwd = trim(getPassword($_POST['login']));//hier wordt het ww behorende bij de loginnaam opgevraagd
                             if (md5(trim($_POST['passwd']))==trim($correct_passwd))//hier wordt het ww behorende bij de loginnaam vergeleken met het opgegeven ww
                                    {
                      
                                            $sql2 = mysqli_query($connection,"SELECT * FROM `user` WHERE `user_inlognaam`='".$_POST["login"]."' AND `user_activ`='yes'");
                      
                                            if (mysqli_num_rows($sql2)==0)  
                                                    {
                                                            die ("U bent nog niet geregistreerd,of uw registratite is nog niet voltooid  ");
                            
                                                    }
                                            while ($row = mysqli_fetch_assoc($sql2))//de login procedure is succesvol doorlopen,dus kunnen de sessie-variabelen nu gemaakt worden
                                                    {
                                                            $userid = $row['user_id'];
                                                            $_SESSION["user_id"] = $userid;
                                                            $_SESSION['user-form'] = $row['user_form-activ'];
                                                            $_SESSION['passwd'] = md5(trim($_POST['passwd']));
                                                            $_SESSION['email'] = $row['user_email'];
                                                            date_default_timezone_set("Europe/Amsterdam");
                                                            $_SESSION['user_sinds'] = $row['user_sinds'];
                                                            $_SESSION['current_date'] = date("y-m-d");
                                                            $_SESSION['current_tijdstip'] = date("H:i:s");
                                            if(!isSet($row['datum_gezien']))//dus als het aacount de eerste keer na registratie en activataie gebruikt word,
                                                    {
                                                            $laatsgezien = $_SESSION['current_date']; // krijgt $laatsgezien de huidige datum(current_date)                           
                                                    }
                                            else 
                                                    {
                                                            $laatsgezien = $row['datum_gezien'];//anders de opgeslagen datum uit de db
                                                    }
                                           if(!isSet($row['tijdstip_gezien']))//dus als het account de eerste keer na registratie en activatie gebruikt word,
                                                    {
                                                            $laatsgezienTijdstip = $_SESSION['current_tijdstip'];//krijgt laatsgezienTijdstip het huidige tijdstip(current_tijdstip) 
                                                    }
                                           else 
                                                    {
                                                            $laatsgezienTijdstip = $row['tijdstip_gezien'];//en anders het opgeslagen tijdstip uit de db
                                                    }
                                                        //Informatie uit de user tabel
                                                           // maakSessieVariabelen();
                                                            $_SESSION['laatsgezien'] = $laatsgezien;
                                                            $_SESSION['laatsgezienTijdstip'] = $laatsgezienTijdstip;                  
                                                            $_SESSION['onlineIP'] = $_SERVER['REMOTE_ADDR'];                             
                                                            $_SESSION["user_authorisatie"] = $auth;
                                                            $_SESSION["loginnaam"] = $_POST["login"];
                                                            $_SESSION["suc6login"] = "suc6login";
                                                    //De kolommen 'datum_gezien' , 'tijdstip_gezien' en 'user_online' van de ingelogde user worden bijgewerkt
                                                        $sql3 = mysqli_query($connection, "UPDATE `user` SET
		                         `user_online` = 'y', `datum_gezien` = '".$_SESSION['current_date']."', `tijdstip_gezien`= '".$_SESSION['current_tijdstip']."'                      
		                         WHERE `user_id` = '".$_SESSION["user_id"]."'")
		                         or die(mysqli_error());
                                                         $useronline = $row['user_online'];
                                                        $_SESSION['useronline'] = $useronline;
                             
            
                             //onlineLog();//Met deze functie(in application/modules/psinfoportal/include/onlineFunctions.php) 
                                           //de tabel 'online' in de database updaten
                             
                           //Terug naar het logon.php script  
                          echo "<script type=\"text/javascript\">
                           window.location = \"".$GLOBALS['path']."/application/modules/humanic-portal/login.php\"
                           </script>";  
              
                        $sql = mysqli_query($connection, "SELECT * FROM `pages` WHERE `page_nav_id`=$pageNavId and `page_show` ='y'");
                        echo "<div class=\"container\">";
                       if (mysqli_num_rows($sql)==0)   
                          {
                            die ("Je hebt geen gegevens tot je beschikking");
                           }
                           while ($content = mysqlì_fetch_assoc($sql)) 
                             {
                               echo "<h1>".$content["page_title"]."</h1>";
                               echo "<br /><p>";
                               echo utf8_encode($content["page_content"]);
                               echo "<br /><p>";
                              }
                        echo "</div>";
                      }
                      //session_unset();;
                                    
                }  
                 else
                 {
                    echo "<b>Het systeem kon u niet inloggen, probeer het nogmaals!</b><br>";
                    $_SESSION["tellerInloggen"]++;
                    if ($_SESSION["tellerInloggen"]<4)
                    {
                    showForm();
                    }
                    else 
                    {
                    echo "<b>Volgens geruchten mag u maar 3 keer inloggen!</b><br>";
                    }
                 }
              }
            }
             else
            {  echo "<b>U moet wel een echt wachtwoord invullen!</b><br>";
                showForm();
            } 
        }   
         else
            {  
                echo "<b>U moet wel een naam en een wachtwoord invullen!</b><br>";
                showForm();
            } 
    }
  
function maakSessieVariabelen() 
{
        global $connection;
        $user_id = $_SESSION['kandidaat_id'];
                     // Eerst gegevens uit de USER-Tabel halen 
                         $sql4 = mysqli_query($connection, "SELECT * FROM `user` WHERE `user_id`='".$user_id."' AND `user_activ`='yes'");
                      
                        if (mysqli_num_rows($sql4)==0)  
                            {
                             die ("U bent nog niet geregistreerd,of uw registratite is nog niet voltooid  ");
                            
                            }
                       while ($row = mysqli_fetch_assoc($sql4))//de login procedure is succesvol doorlopen,dus kunnen de sessie-variabelen nu gemaakt worden
                         {
                              $_SESSION['kandidaatLogin'] = $row['user_inlognaam'];
                             $_SESSION['achternaam'] = $row['achternaam'];
                             $_SESSION['tussenvoegsel'] = $row['tussenvoegsel'];
                             $_SESSION['voornaam'] = $row['voornaam'];
                             $_SESSION['straat'] = $row['straat'];
                             $_SESSION['huisnummer'] = $row['huisnummer'];
                             $_SESSION['toevoeging'] = $row['toevoeging'];
                             $_SESSION['postcode'] = $row['postcode'];
                             $_SESSION['plaats'] = $row['plaats'];
                             $_SESSION['telefoon'] = $row['telefoon'];
                             $_SESSION['foto'] = $row['foto'];
                             if(isSet($row['cv'])){$_SESSION['cv'] = $row['cv'];}
                             else {$_SESSION['cv'] = "";}
                             $_SESSION['geb-datum'] = $row['geboortedatum'];
                             $_SESSION['salaris'] = $row['salaris'];
                             $_SESSION['uitkering'] = $row['uitkering'];
                             //$_SESSION['uitkeringGeldigTot'] = date_format($row['uitkering_geldig_tot'], "F Y");
                             $_SESSION['uitkeringGeldigTot'] = $row['uitkering_geldig_tot'];
                             $_SESSION['bedrijf-grootte'] = $row['user_bedrijf_grootte'];
                             $_SESSION['rijbewijs'] = $row['rijbewijs'];
                             $_SESSION['auto'] = $row['auto'];
                             $_SESSION['reisafstand'] = $row['reisafstand'];
                             $_SESSION['linkedIn'] = $row['linkedin'];
                             $_SESSION['facebook'] = $row['facebook'];
                             $_SESSION['twitter'] = $row['twitter'];
                             $_SESSION['opmerking'] = $row['opmerking'];
                         }

}
    
    
    
    
    
    
function getAuthorisatie($usernaam)    
{
      global $connection;

      $auth = "usr";
      $sql = mysqli_query($connection, "SELECT * FROM `user`");
      if (mysqli_num_rows($sql)==0)  
        {
            die ("Je heb geen gegevens tot je beschikking");
        }
        while ($row = mysqli_fetch_assoc($sql)) 
        {           
            if (strtolower($usernaam) == strtolower($row['user_inlognaam']))
            { 
            $auth = $row['user_authorisatie'];
            }
        }
      return $auth;
    }  

 function getPassword($usernaam)
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
            if (strtolower($usernaam) == strtolower($row['user_inlognaam']))
            { 
            $pass = $row['user_wachtwoord'];
            }
        }
      return $pass;
    }   
    

function error()
    {
        echo "<br/><br/>";
        echo "<h1>U bent nog niet ingelogd!</h1><br>";
        echo "Klik <a href=\"login.php\"> hier </a> om in te loggen<br>";
    }
    
function bedankt()
    {
        if (isSet($_SESSION["loginnaam"]))
        {
        echo "<h1>Bedankt</h1>";
        echo "Beste ".ucfirst($_SESSION["loginnaam"]).",<br>";
        echo "bedankt voor uw bezoek aan onze website. Tot ziens, tot de volgende keer.";
        }
    }

function showAanmeldForm($naam="",$email="")
    {
        global $email;
        global $naam;
        if(isSet($_POST['reglogin'])&& $_POST['reglogin']!=""){$naam = $_POST['reglogin']; }
        if(isSet($_POST['emailuser'])&& $_POST['emailuser']!=""){$email = $_POST['emailuser']; }
        echo "<section id=\"aanmeldblok\">";
        echo "<h4 class=instappen>Instappen werkzoekenden!<br/>";
        echo "Registreren</h4>";
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>";
        echo "<table id=\"login\">";
        echo "<tr><td>Typ uw login naam:</td>";
        echo "<td><input type='text' name='reglogin' value='".$naam."'</td></tr>";
        echo "<tr><td>&nbsp</td></tr>";
        echo "<tr><td>E-mailadres: </td>";
        echo "<td><input type='text' name='emailuser' value='".$email."'></td></tr>";
        echo "<tr><td>&nbsp</td></tr>";
        echo "<tr><td>Typ uw wachtwoord:</td>";
        echo "<td><input type='password' name='regpasswd1'</td></tr>";
        echo "<tr><td>&nbsp</td></tr>";
        echo "<tr><td>Herhaal uw wachtwoord:</td>";
        echo "<td><input type='password' name='regpasswd2'></td></tr>";
        echo "</table>";
        echo "<input type='submit' name='regsubmit' value='Registreren'>";
        echo "</form>";
        echo "</section>";
    }   
    
function handleAanmeldForm()
    {
        global $connection;
      
      if (isSet($_POST['regsubmit']) && isSet($_POST["regpasswd1"]) && $_POST["regpasswd1"] !=""
                && isSet($_POST["regpasswd2"]) && $_POST["regpasswd2"] !=""
                && isSet($_POST["reglogin"]) && $_POST["reglogin"] !="")
       {  

        // Initialiseer fout variabelen
        global $fout;
        $fout=FALSE;
        $naam_fout=False;
        $email_fout=FALSE;
        $naamdouble_fout=FALSE;
        $emailsyntax_fout=FALSE;
        $emaildouble_fout=FALSE;

        // controleer op fouten
        if ($_POST["reglogin"] == "")
	{
	    $fout=TRUE;
	    $naam_fout=TRUE;
	}

	if ($_POST["emailuser"] == "")
	{
	    $fout=TRUE;
	    $email_fout=TRUE;
	}
        
        $controle = check_email($_POST['emailuser']);//returncode van de functie check_email($email)is false of true  
        if($controle == false)
               {
                  $fout=TRUE;
                  $emailsyntax_fout=TRUE;
                } 
        
        $usrdouble = getUsername($_POST['reglogin']);
        if ($usrdouble==true)
               {
                  $fout=TRUE;
                  $naamdouble_fout=TRUE;
               }
                  // controleer of er fouten zijn
       if($fout)
          {
                       // er zijn fouten
            // geef het lijstje van fouten
            echo "<UL><h4>";
            echo ($naam_fout?"<li>U heeft geen loginnaam ingevuld</li>":"");
            echo ($naamdouble_fout?"<li>Deze naam is al in gebruik</li>":"");
            echo ($email_fout?"<li><em>U heeft geen e-mailadres ingevuld</em></li>":"");
            echo ($emailsyntax_fout?"<li><em>U heeft geen geldig email-adres ingevuld</em></li>":"");   
            echo ($emaildouble_fout?"<li><em>Dit email-adres wordt al gebruikt</em></li>":"");
            
            echo "</h4></UL>";            
            // Geef het formulier opnieuw
            ShowRegForm($_POST["reglogin"], $_POST['emailuser']);
            
            
               }
             else
                {
                   // er zijn geen fouten
                  echo "<h4 class=\"regdata\">Uw login gegevens:</h4><hr>";
                  echo"<table class=\"gegevens\">";
                  echo "<tr><td>Loginnaam:</td><td><h5> ".$_POST["reglogin"]."</h5></td></tr>";
                  echo "<tr><td>E-Mail:</td><td><h5> ".$_POST['emailuser']."</h5></td></tr>";
                  echo "</table>";
                  
                  $_SESSION['loginnaam']= ucfirst($_POST['reglogin']);    
                // controle op dezelfde wachtwoorden (typfoutencheck)
                if ($_POST['regpasswd1']==$_POST['regpasswd2'])
                {
                    $_SESSION['regpasswd']=$_POST['regpasswd1'];
                    $code=uniqid(); // deze moet je zelf ook hebben om op te kunnen controleren later 
                    $_SESSION['code'] = $code;
                    reglinkVerzenden ($_POST['emailuser'],$_POST['regpasswd1'],$_SESSION['code']);
                   //else //emailadres is correct
                       
                               $servername = "localhost:7777";
                               $username = "root";
                               $password = "123";
                               $dbname = "kandidaten";
                    
                    $sql = mysqli_query($connection, "INSERT INTO user (`user_inlognaam`, `user_wachtwoord`,`user_email`,`activ_code`)
                        VALUES ('".$_POST['reglogin']."', '".md5($_POST['regpasswd1'])."', '".$_POST['emailuser']."', '".$_SESSION['code']."')");
                    if (mysqli_affected_rows($connection)==0)
                    {
                        //de gegevens zijn niet toegevoegd.
                        echo "error adding info, try again later";
                    } 
                    else
                    {
                        
                       session_destroy();
                      /* echo "<div id=\"welkomPieter\">";
                       echo "<h3> U bent nu een stap verwijderd van registratie!<br>";
                       echo "Er is een email naar ".$_POST['emailuser']." verzonden met een activeringslink,<br> ";
                       echo "u kunt <a href=\"login.php\"> inloggen</a> nadat u hierop heeft geklikt,</h3></div>";
                       echo "";*/
                       echo "<h4 class=\"regdata\">";
                       echo "Nadat u bent ingelogd kunt u verder gaan met de registratie<br>";
                       echo "Er is een email verzonden naar  ".$_POST['emailuser']." met een activatie link,<br>";
                       echo "u kunt<a href=\"login.php\"> inloggen </a> nadat u hierop heeft geklikt.";
                       echo "</h4>";
                       /* echo "<script type=\"text/javascript\">
                    window.location = \"".$GLOBALS['path']."/application/modules/psinfoportal/verify.php\"
                    </script>";  */
                       
                       
                       
                     //  reglinkVerzenden($_POST['reglogin'],$_POST['regpasswd1'],$_POST['emailuser']);
                    //echo "U bent nu bij ons geregistreerd.<br/>";
                    //echo "U kunt <a href=\"login.php\"> hier </a> nu inloggen<br>"; 
                    }
                }    
                  
                   else
                    {  
                    echo "<b>De wachtwoorden komen niet overeen, probeer het nogmaals!</b><br>";
                    showRegForm();
                    }
               }
          } 
          else
              if ($_POST["reglogin"] == "")
              {
                  echo "<h4>U heeft geen loginnaam ingevuld</h4>";
                  showRegForm();
              }
              else
                {  
                  echo "<b>U moet wel een naam en 2x hetzelfde wachtwoord invullen!</b><br>";
                  showRegForm();
                } 
    } 
   
function getUsername($usernaam) //controle op dubbele loginnaam
    {
        global $connection;

        $usrdouble = false;
        $sql = mysqli_query($connection, "SELECT * FROM `user`");
        if (mysqli_num_rows($sql)==0)  
        {
            die ("Je heb geen gegevens tot je beschikking");
        }
        while ($row = mysqli_fetch_assoc($sql)) 
        {           
            if (strtolower($usernaam) == strtolower($row['user_inlognaam']))
            { 
            $usrdouble = true;
            }
        }
        return $usrdouble;
    }
    
    
function check_email($email) { // return TRUE or FALSE
  $patroon = "/^([a-z0-9_-]+\.)*[a-z0-9_-]+@([a-z0-9_-]{2,}\.)+([a-z0-9_-]{2,})$/i";
  return preg_match($patroon, $email);
}    


function uitloggen()
{
  global $connection;

  If(isSet($_SESSION['user_id']))
  {    
  $sql = mysqli_query($connection, "UPDATE `user` SET `user_online`='n' WHERE `user_id` = ".$_SESSION['user_id']." ") or die(mysqli_error());
  }
   // Unset all of the session variables.
  $_SESSION = array();
  session_destroy();        
              
}



function getUseremail($useremail) //controle op dubbele loginnaam
    { 
        global $connection;

        $emaildouble = false;
        $sql = mysqli_query($connection, "SELECT * FROM `user`");
        if (mysqli_num_rows($sql)==0)  
        {
            die ("Je heb geen gegevens tot je beschikking");
        }
        while ($row = mysqli_fetch_assoc($sql)) 
        {           
            if ($useremail == $row['user_email'])
            { 
            $emaildouble = true;
            }
        }
        return $emaildouble;
    }

function reglinkVerzenden ($regemail,$regpasswd,$code)
{

$code = $_SESSION['code'];
$subject = 'Uw registratie afronden';

$email="Uw Loginnaam: ".$_SESSION['loginnaam']."
Uw wachtwoord: ".$_SESSION['regpasswd']."
Klik op deze link: http://www.localhost:7777/humanic/application/modules/humanic/verify.php?acode=$code\ ,om u te kunnen verifieren";
$to = $regemail;
$from = 'frankieboy37@hotmail.com';

ini_set('sendmail_from', $from);

$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=iso-8859-1";
$headers[] = "From: HumanIC <{$from}>";
$headers[] = "Reply-To: HumanIC <{$from}>";
//$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/".phpversion();

mail($to, $subject, $email, implode("\r\n", $headers) ); 
    
    
}

/*
// function om het bestelformulier te laten zien       
function showBestelForm($naam="", $adres="", $postcode="", $woonplaats="", $land="nederland", $telefoon="", $email="")//deze functie heb ik niet meer gebruikt
    {
        global $PHP_SELF;
        echo "<h1>Gratis bestelling van 'Please please me's number one'</h1>";
        echo "<h2>Vul hieronder uw persoonsgegevens in:</h2><br />";
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method=post>";
        echo "<table class=\table\">";
        echo "<tr><td id=\"bestelL\">Naam: </td><td id=\"bestelR\"><input type='text' name='naam' value='$naam'></td></tr>";
        echo "<tr><td id=\"bestelL\">Adres: </td><td id=\"bestelR\"><input type='text' name='adres' value='$adres'></td></tr>";
        echo "<tr><td id=\"bestelL\">Postcode: </td><td id=\"bestelR\"><input type='text' name='postcode' value='$postcode'></td></tr>";
        echo "<tr><td id=\"bestelL\">Woonplaats: </td><td id=\"bestelR\"><input type='text' name='woonplaats' value='$woonplaats'></td></tr>";
        echo "<tr><td id=\"bestelL\">Land: </td><td id=\"bestelR\"><input type='text' name='land' value='$land'</td></tr>";
        echo "<tr><td id=\"bestelL\">Telefoonnr: </td><td id=\"bestelR\"><input type='text' name='telefoon' value='$telefoon'></td></tr>";
        echo "<tr><td id=\"bestelL\">E-mailadres: </td><td id=\"bestelR\"><input type='text' name='email' value='$email'></td></tr>";
        echo "<tr><td id=\"bestelL\">Aantal exemplaren(maximaal 4): </td><td id=\"contactR\">";
        echo "<input type='radio' name='aantal' value='1' checked='true' >1
         <input type='radio' name='aantal' value='2'>2
         <input type='radio' name='aantal' value='3'>3
         <input type='radio' name='aantal' value='4'>4<br /></td></tr>";
        echo "</table><br />"; 
        echo "<input type='submit' name='submit' value='Verzenden'><br /><br />";
        echo "</form>";
      } */

/*
function handleBestelForm()//deze functie heb ik niet meer gebruikt
 {  
        global $connection;

        $boek_id = "9";
        $boek_titel = "Please please me's number one";
        $email = $_POST['email'];
        $telefoon = $_POST["telefoon"]; 
        $naam = $_POST['naam'];
        $adres = $_POST["adres"];
        $postcode = $_POST["postcode"];
        $woonplaats = $_POST["woonplaats"];
        $land = $_POST['land'];
       
        // BK: Hoe gaat dit i.c.m. de lokale variabelen hierboven?
         global $naam;
            global $adres;
            global $postcode;
            global $woonplaats;
            global $telefoon;
            global $email;
            valid_naam($naam);
            valid_adres($adres);
            valid_postcode($postcode);
            valid_woonPlaats($woonplaats);
            valid_telefoon($telefoon);
    
        // handel het formulier af
        // Initialiseer fout variabelen
        $fout=FALSE;
        $naam_fout=FALSE;
        $adres_fout=FALSE;
        $postcode_fout=FALSE;
        $woonplaats_fout=FALSE;
        $telefoon_fout=FALSE;
        $email_fout=FALSE;
        $naamsyntax_fout=FALSE;
        $adressyntax_fout=FALSE;
        $postcodesyntax_fout=FALSE;
        $woonplaatssyntax_fout=FALSE;
        $telefoonsyntax_fout=FALSE;
        $emailsyntax_fout=FALSE;

        // controleer op lege velden en syntaxfouten
        if ($_POST["naam"] == "")
	{
	    $fout=TRUE;
	    $naam_fout=TRUE;
	}

	if ($_POST["adres"] == "")
	{
	    $fout=TRUE;
	    $adres_fout=TRUE;
	}
        if ($_POST["postcode"] == "")
	{
	    $fout=TRUE;
	    $postcode_fout=TRUE;
	}

	if ($_POST["woonplaats"] == "")
	{
	    $fout=TRUE;
	    $woonplaats_fout=TRUE;
	}
	if ($_POST["telefoon"] == "")
	{
	    $fout=TRUE;
	    $telefoon_fout=TRUE;
	}

	if ($_POST["email"] == "")
	{
	    $fout=TRUE;
	    $email_fout=TRUE;
	}

        if(!valid_naam($_POST["naam"]))
        {
            $fout=TRUE;
            $naamsyntax_fout=TRUE;
        }
        if(!valid_adres($_POST["adres"]))
        {
          $fout=TRUE;
          $adressyntax_fout=TRUE;
        }
        if(!valid_postcode($_POST["postcode"]))
        {
           $fout=TRUE;
           $postcodesyntax_fout=TRUE;
        }
        if(!valid_woonplaats($_POST["woonplaats"]))
        {
          $fout=TRUE;
          $woonplaats_fout_fout=TRUE;
        }
        if(!valid_telefoon($_POST["telefoon"]))
        {
          $fout=TRUE;
          $telefoonsyntax_fout=TRUE;
        }
        $controle = check_email($_POST['email']);//returncode van de functie check_email($email)is false of true  
        if($controle == false)
               {
                  $fout=TRUE;
                  $emailsyntax_fout=TRUE;
                }
        

        // controleer of er fouten zijn
        if ($fout)
        {
            // er zijn fouten
            // geef het lijstje van fouten
            echo "<UL>";
            echo ($naam_fout?"<li>U heeft geen naam ingevuld</li>":"");
            echo ($naamsyntax_fout?"<li>Deze naam is niet toegestaan</li>":"");
            echo ($adres_fout?"<li>U heeft geen adres ingevuld</li>":"");
            echo ($adressyntax_fout?"<li>Vul een geldig adres in</li>":"");
            echo ($postcode_fout?"<li>U heeft geen postcode ingevuld</li>":"");
            echo ($postcodesyntax_fout?"<li>Deze postcode bestaat niet</li>":"");
            echo ($woonplaats_fout?"<li>U heeft geen woonplaats ingevuld</li>":"");
            echo ($woonplaatssyntax_fout?"<li>Deze plaats bestaat niet</li>":"");
            echo ($telefoon_fout?"<li>U heeft geen telefoonnummer ingevuld</li>":"");
            echo ($telefoonsyntax_fout?"<li>Dit telefoon-nummer is niet correct</li>":"");
            echo ($email_fout?"<li>U heeft geen e-mailadres ingevuld</li>":"");
            echo ($emailsyntax_fout?"<li><em>U heeft geen geldig email-adres ingevuld</em></li>":""); 
            echo "</UL>";            
            // Geef het formulier opnieuw
         showBestelForm($_POST["naam"], $_POST["adres"], $_POST["postcode"], $_POST["woonplaats"],$_POST['land'], $_POST["telefoon"], $_POST["email"]);

        } 
       
       else //Er zijn geen fouten,presenteer de gegevens  
       {
        
          $sql = mysqli_query($connection, "INSERT INTO bestelling (`boek_id`,`user_id`,`user_inlognaam`, `boek_titel`, `aantal`,
              `user_email`,`bestelling_naam`,`straatnaam`, `postcode`, `woonplaats`, `land`, `mobiel`)
              VALUES ('".$boek_id."', '".$_SESSION['user_id']."', '".$_SESSION['loginnaam']."', '".$boek_titel."', '".$_POST['aantal']."',"
                  . " '".$_POST['email']."', '".$_POST['naam']."', '".$_POST['adres']."', '".$_POST['postcode']."',"
                  . " '".$_POST['woonplaats']."', '".$_POST['land']."','".$_POST['telefoon']."')");
                 if (mysqli_affected_rows($connection)==0)
                    {
                        //de gegevens zijn niet toegevoegd.
                        echo "error adding info, try again later";
                    } 
                    else
                    {
                        
                     echo "<h3>Uw Bestelling is succesvol verstuurd,de afhandeling kan 2 weken duren !</h3>";
                     echo "<h4>Dit zijn uw Gegevens</h4><hr>";
                     echo "<table class=\table\"><h5>";
                     echo "<tr><td id=\"bestelL\">User-ID:</td><td id=\"bestelR\"> ".$_SESSION['user_id']."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Inlognaam:</td><td id=\"bestelR\">".$_SESSION['loginnaam']."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Naam:</td><td id=\"bestelR\"> ".$_POST["naam"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Adres:</td><td id=\"bestelR\"> ".$_POST["adres"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Postcode:</td><td id=\"bestelR\"> ".$_POST["postcode"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Woonplaats:</td><td id=\"bestelR\"> ".$_POST["woonplaats"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Land:</td><td id=\"bestelR\"> ".$_POST['land']."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Telefoon:</td><td id=\"bestelR\"> ".$_POST["telefoon"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">E-Mail:</td><td id=\"bestelR\"> ".$_POST["email"]."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Boek-ID:</td><td id=\"bestelR\"> ".$boek_id."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Boek-titel:</td><td id=\"bestelR\"> ".$boek_titel."</td></tr>";
                     echo "<tr><td id=\"bestelL\">Aantal besteld:</td><td id=\"bestelR\">".$_POST['aantal']."</td></tr>";
                     echo "</h5></table>";
                    }
       
     }
   } */
   

 function showContactForm($naam="",$email="",$subject="",$bericht="")
 {
   if(isSet($_POST['naam'])){$naam = $_POST['naam']; }
   if(isSet($_POST['email'])){$email = $_POST['email'];}
   if(isSet($_POST['subject'])){$subject = $_POST['subject'];}
   if(isSet($_POST['bericht'])){$bericht = $_POST['bericht'];}
   //echo "<p>";
   echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method=post>";
   echo "<table class=\table\">";
   echo "<tr><td id=\"contactL\">Name:</td><td id=\"contactR\"><input type='text' name='naam' value='$naam'></td></tr>";
   echo "<tr><td id=\"contactL\">E-mailadress:</td><td id=\"contactR\"><input type='text' name='email' value='$email'></td></tr>";
   echo "<tr><td id=\"contactL\">Subject:</td><td id=\"contactR\"><input type='text' name='subject' value='$subject'></td></tr>";
   echo "<tr><td id=\"contactL\">Message:</td><td id=\"contactR\">";
   echo "<textarea name=\"bericht\" cols=\"80\" rows=\"6\" value='$bericht'></textarea></td></tr>";
   echo "</table>";
   echo "<input type='submit' name='submit' value='Submit'>";
   echo "</form>";
   
   //echo "</p>";

 }
 
 function handleContactForm ()
 {
        global $connection;

          // Initialiseer fout variabelen
        $fout=FALSE;
        $naam_fout=FALSE;
        $naamsyntax_fout=FALSE;
        $email_fout=FALSE;
        $emailsyntax_fout=FALSE;
        $subject_fout=FALSE;
        $bericht_fout=FALSE;
     
             // controleer op lege velden
        if ($_POST["naam"] == "")
	{
	    $fout=TRUE;
	    $naam_fout=TRUE;
	}
       if ($_POST["email"] == "")
	{
	    $fout=TRUE;
	    $email_fout=TRUE;
	}
       if ($_POST["subject"] == "")
	{
	    $fout=TRUE;
	    $subject_fout=TRUE;
	}
        if ($_POST["bericht"] == "")
	{
	    $fout=TRUE;
	    $bericht_fout=TRUE;
	}     
       if(!valid_naam($_POST["naam"]))
        {
            $fout=TRUE;
            $naamsyntax_fout=TRUE;
        }
         $controle = check_email($_POST['email']);//returncode van de functie check_email($email)is false of true  
        if($controle == false)
               {
                  $fout=TRUE;
                  $emailsyntax_fout=TRUE;
                }
        
        // controleer of er fouten zijn
     if ($fout)
      {
           // er zijn fouten
           // geef het lijstje van fouten    
         /* echo "<UL>";
          echo ($naam_fout?"<li>U heeft geen naam ingevuld</li>":"");
          echo ($naamsyntax_fout?"<li>Deze naam is niet toegestaan</li>":"");
          echo ($email_fout?"<li>U heeft geen e-mailadres ingevuld</li>":"");
          echo ($emailsyntax_fout?"<li><em>U heeft geen geldig email-adres ingevuld</em></li>":"");
          echo ($subject_fout?"<li>U heeft geen onderwerp ingevuld</li>":"");     
          echo ($bericht_fout?"<li>U heeft geen bericht ingevuld</li>":"");
          echo "</UL>";*/
         
          echo "<UL>";
          echo ($naam_fout?"<li>The name field is blank</li>":"");
          echo ($naamsyntax_fout?"<li>This name is not allowed</li>":"");
          echo ($email_fout?"<li>Enter an email address</li>":"");
          echo ($emailsyntax_fout?"<li><em>Enter a valid email address</em></li>":"");
          echo ($subject_fout?"<li>Enter a subject</li>":"");     
          echo ($bericht_fout?"<li>You have no message</li>":"");
          echo "</UL>";
          // Geef het formulier opnieuw
        showContactForm($_POST['naam'], $_POST['email'], $_POST['subject'], $_POST['bericht']);
      
      }

     else//Er zijn geen fouten
     {
       if(isSet($_SESSION['loginnaam']))
         {
          $sql = mysqli_query($onnection, "INSERT INTO contact (`user_id`,`user_inlognaam`, `contact_naam`,`contact_email`,`contact_subject`,`contact_bericht`)
              VALUES ('".$_SESSION['user_id']."', '".$_SESSION['loginnaam']."', '".$_POST['naam']."', '".$_POST['email']."', '".$_POST['subject']."', '".$_POST['bericht']."')");
                 if (mysqli_affected_rows($connection)==0)
                    {
                        //de gegevens zijn niet toegevoegd.
                        echo "error adding info, try again later";
                    } 
                    else
                    {
                      echo "<h3>Your message has been sent successfully.</h3>";
                      echo "<h4>These are your data:</h4><hr>";
                      echo "<table class=\table\">";
                      echo "<tr><td div id=\"messageL\">User ID:</td></div><td div id=\"messageR\"> ".$_SESSION['user_id']."</td></div></tr>";
                      echo "<tr><td id=\"messageL\">Login:</td><td id=\"messageR\"> ".$_SESSION['loginnaam']."</td></tr>";
                      echo "<tr><td id=\"messageL\">Name:</td><td id=\"messageR\"> ".$_POST['naam']."</td></tr>";
                      echo "<tr><td id=\"messageL\">Email:</td><td id=\"messageR\"> ".$_POST['email']."</td></tr>";
                      echo "<tr><td id=\"messageL\">Subject:</td><td id=\"messageR\"> ".$_POST['subject']."</td></tr>";
                      echo "<tr><td id=\"messageL\">Message:</td><td id=\"messageR\"> ".$_POST['bericht']."</td></tr>";
                      echo "</table>";                           
                    }        
            }
          else
            {
                   $sql = mysqli_query($connection, "INSERT INTO contact (`contact_naam`,`contact_email`,`contact_subject`,`contact_bericht`)
              VALUES ('".$_POST['naam']."', '".$_POST['email']."', '".$_POST['subject']."', '".$_POST['bericht']."')");
                 if (mysqli_affected_rows($connection)==0)
                    {
                        //de gegevens zijn niet toegevoegd.
                        echo "error adding info, try again later";
                    } 
                    else
                    {
                        echo "<h3>Your message has been sent successfully</h3>";
                      echo "<h4>These are your data:</h4><hr>";
                      echo "<table class=\table\"><h5>";
                      echo "<tr><td id=\"contactL\">User ID:</td><td></td></tr>";
                      echo "<tr><td id=\"contactL\">User Loginname:</td><td></td></tr>";
                      echo "<tr><td id=\"contactL\">Contact Name:</td><td id=\"contactR\"> ".$_POST['naam']."</td></tr>";
                      echo "<tr><td id=\"contactL\">Contact Email:</td><td id=\"contactR\"> ".$_POST['email']."</td></tr>";
                      echo "<tr><td id=\"contactL\">Contact Subject:</td><td id=\"contactR\"> ".$_POST['subject']."</td></tr>";
                      echo "<tr><td id=\"contactL\">Contact Message:</td><td id=\"contactR\"> ".$_POST['bericht']."</td></tr>";
                      echo "</h5></table>";                                
                    }  
             }
     }
  
 }
 
 function showKandidaatRegForm () 
 { 
    global $connection;
    global $cvpath;
    
    global $connection;
$sql = mysqli_query($connection, "SELECT * FROM user WHERE `user_id` = '".$_SESSION['kandidaat_id']."'");
    if ($sql){
        while ($row = mysqli_fetch_assoc($sql)) {
            $motivatie =  $row['motivatie'];
        }
    }
    else {
        echo "fout";
    };
if(isSet($motivatie)){
    $_SESSION['motivatie'] = $motivatie;
}


    
    echo " <div class=\"container\">";
            echo "<h3 class=\"profiel\">Het profiel van ".$_SESSION['voornaam']." ".$_SESSION['tussenvoegsel']." ".$_SESSION['achternaam']."</h3>";          
           echo "<form id=\"fuikweb-register\" action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method=\"post\"  enctype=\"multipart/form-data\" role=\"form\">";
           // echo "<form id=\"data\" action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method=\"post\"  enctype=\"multipart/form-data\" role=\"form\">"; 
                persoonlijkeGegevens();		                                               
                toonFuncties();
                toonMobielUitkering();
                toonSector();
                toonRegio();
                toonOpmerkingen();
               $_files="";    
                echo "<section id=\"opslaan\">";
                        echo "<br><br>";
                        echo "<div class=\"text-right\">";
                            echo "<div >";
                            //echo "<input type='submit' name='submit' value='Verzenden'><br /><br />";
                            echo "<button id=\"submit\" class=\"col-sm-6 btn btn-primary btn-md\" type=\"submit\" name=\"submit\" value='Verzenden' >Opslaan</button>";
                            //echo "<button class=\" col-sm-5 btn btn-primary btn-md\" type=\"button\" name=\"wissen\">Wissen</button>";
                        echo "</div>";	
                echo "</section>";
            echo "</form>";
    echo "</div>";
			
}

function handleKandidaatRegForm () 
 {
    
  /*  if($_FILES['foto'])
                {
                    //echo "conditie 2, de foto is gewijzigd<br/>";
                    verwerkFoto();
                    }
   if($_FILES['cv'])
                {
                    //echo "conditie 3, de cv is veranderd<br/>";
                    verwerkCV();
                    } */           
     verwerkUser();
   /*  verwerkFunctie();
     verwerkRegio();
     verwerkSector();
     verwerkBedrijf();*/
     error_reporting(0);
    // maakSessieVariabelen();     
     header("Refresh:0");
     showKandidaatRegForm();
     error_reporting(E_ALL);
 }
 
 function persoonlijkeGegevens(){
    $voornaam = variableWaarde('voornaam');
    $tussenvoegsel = variableWaarde('tussenvoegsel');
    $achternaam = variableWaarde('achternaam'); 
    $straat = variableWaarde('straat');
    $huisnr = variableWaarde('huisnummer');
    $toevoeging = variableWaarde('toevoeging');
    $postcode = variableWaarde('postcode');
    $woonplaats = variableWaarde('plaats');
    $telefoon = variableWaarde('telefoon');
    $geboorteDatum = variableWaarde('geb-datum');
    $email = variableWaarde('email');  // is al bekend in de aanmeld fase , zie aanmeld afhandeling vanaf r443
    $loginnaam = $_SESSION['kandidaatLogin']; 
    $cv = $_SESSION['cv'];
    $motivatie = variableWaarde('motivatie');
    $foto = $_SESSION['foto'];
    $linkedIn = variableWaarde('linkedIn');
    $facebook = variableWaarde('facebook');
    $twitter = variableWaarde('twitter');  
    
        switch ($motivatie) {
        case 'mot9':
            $mot9 = "seleced";
        case 'mot7' : 
            $mot7 = "selected";
            break;
        case 'mot5' : 
            $mot5 = "selected";
            break;
        case 'mot3' : 
            $mot3 = "selected";
            break;
        case 'mot1' : 
            $mot1 = "selected";
            break;
    }
    
    
    
    
     
    global $cvpath;
    echo "<section id=\"persoonlijke-gegevens\">";
        echo "<section id=\"personalia\">";
            echo "<div class=\"kop\">";
               // echo "<p>Vul je persoonlijke gegevens in, velden met een * zijn verplicht.</p>";
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3 text-left\" for=\"login-naam\">Loginnaam: </label>";
                //<input type="text" class='form-control' id="login-naam" name="LoginNaam" required="required" autofocus="autofocus"/> -->
                echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control\" id=\"login-naam\" name=\"LoginNaam\" value='$loginnaam' readonly/>";
                echo "</div>";
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"achternaam\">Achternaam *</label>";
                echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"achternaam\" name=\"achternaam\" value='$achternaam' readonly  required=\"required\" autofocus=\"autofocus\"/>";
                echo "</div>";	
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"tussenvoegsel\">Tussenvoegsel</label>";
                echo "<div class=\"col-sm-3\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"tussenvoegsel\" name=\"tussenvoegsel\" value='$tussenvoegsel'readonly />";
                echo "</div>";	
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3 text-left\" for=\"voornaam\">Voornaam *</label>";
                echo "<div class=\"col-sm-9\">";
                        echo "<input type=\"text\" class=\"form-control input-sm\" id=\"voornaam\" name=\"voornaam\" value='$voornaam' readonly required=\"required\"  />";
                echo "</div>";
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\" col-sm-3\"  for=\"email\">Email</label>";
                echo "<div class=\"col-sm-9\">";                        
                    echo "<input type=\"email\" class=\"form-control input-sm\" id=\"email\" name=\"email\" value='$email'  readonly/>";
                echo "</div>";
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3 col-offset-1\" for=\"straat\">Straat </label>";
                echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"straat\" name=\"straat\" value='$straat' readonly/>";
                echo "</div>";
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"huisnummer\">Huisnummer</label>";
                echo "<div class=\"col-sm-2\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"huisnummer\" name=\"huisnummer\" value='$huisnr' readonly>";
                echo "</div>";
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"toevoeging\">Toevoeging</label>";
                echo "<div class=\"col-sm-3\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"toevoeging\" name=\"toevoeging\"/ value='$toevoeging' readonly>";
                echo "</div>";
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"postcode\">Postcode</label>";
                echo "<div class=\"col-sm-3\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"postcode\" name=\"postcode\" value='$postcode'  readonly placeholder=\"1032CJ\"/>";
                echo "</div>";	
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"plaats\">Plaats</label>";
                echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"plaats\" name=\"plaats\" value='$woonplaats' readonly />";
                echo "</div>";	
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"geboortedatum\">Geboortedatum</label>";
                echo "<div class=\"col-sm-4\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"geboortedatum\" name=\"geboortedatum\" value='$geboorteDatum' readonly placeholder=\"dd-mm-jjjj\"/>";
                echo "</div>";	
            echo "</div>";
            
            echo "<div class=\"row\">";
                echo "<label class=\"col-sm-3\" for=\"telefoon\">Telefoon *</label>";
                echo "<div class=\"col-sm-4\">";
                    echo "<input type=\"tel\" class=\"form-control input-sm\" id=\"telnr\" name=\"telefoon\" value='$telefoon'  readonly autocomplete = \"on\" required=\"required\"/>";
                echo "</div>";	
            echo "</div>";
        echo "</section>";
        global $path;
        global $imagepath;
        global $cvpath;
 echo "<section id=\"sociaal_foto\">";
           echo "<div id=\"foto\" class=\"form-group\">";
                            
                    echo "<label  for=\"foto\">Foto uploaden</label>";
                    echo "<div>";
                    
                            if(isSet($_SESSION['foto'])){
                           // echo "<img class=\"col-sm-4\" id=\"myImg\" src=\"$imagepath"."$foto\" alt=\"your image\" width=80px height=80px style=\"margin: 5px;\"/>";
                                echo "<img class=\"col-sm-4\" id=\"myImg\" src=\"$imagepath"."$foto\" alt=\"your image\" width=100px height=100px style=\"margin: 5px;\"/>";
                                }
                            //echo "<input class=\"col-sm-3\" type=\"file\" id=\"foto\" name=\"foto\" onchange=\"previewFiles()\" multiple>";
                            
                             /* echo "<div class=\"row\">";
                              echo "<label class=\"col-sm-3\" for=\"plaats\">Motivatie: </label>";
                              echo "<div class=\"col-sm-9\">";
                              echo "<input type=\"text\" class=\"form-control input-sm\" id=\"motivatie\" name=\"motivatie\" value='$motivatie'/>";*/
                              echo "<select class=\"form-control input-sm\" name=\"motivatie\" id=\"motiv\" value=$motivatie>";
                              echo   "<option value=\"mot9\" $mot9>zeer gedreven</option>
                                        <option value=\"mot7\" $mot7>aan motivatie geen gebrek</option>
                                        <option value=\"mot5\" $mot5>passief, maar wel geinteresseerd</option>
                                        <option value=\"mot3\" $mot3>popie jopie type</option>
                                        <option value=\"mot1\" $mot1>niet vooruit te branden</option>";
                            echo "</select>";  
                                
                                
                                
                              
                    echo "</div>";	
            echo "</div>";

 echo "</section>"; 
 echo "<section id=\"cv-upload\">";      
            echo "<div id=\"cv\" class=\"form-group\">";
                 //echo "<label  for=\"cv\">CV uploaden of inzien</label>";
                 echo "<div id=\"cvInzien\" >";
                        if ($_SESSION['cv'] != ""){ 
                            echo "<a href=\"$cvpath".$_SESSION['cv']."\"  TARGET=\"_blank\"><span class=\"cvText\">De cv inzien.</span></a><br/><br/>";
                        }
                         //echo "<mark>CV UPLOADEN.</mark><br/><br/>";
                       // echo "<input class=\"col-sm-6\" type=\"file\" class=\"form-control\" id=\"cv\" name=\"cv\"  />";                    
                 echo "</div>";
            echo "</div>";
 echo "</section>";
        
 echo "<section id=\"sociale_media\">";
            echo "<div class=\"form-group\">";
                echo "<label class=\"control-label col-sm-3\" for=\"linkedin\">LinkedIn</label>";
                echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"linkedin\" name=\"linkedIn\" value='$linkedIn' readonly  placeholder=\"linkedIn link\" />";
                echo "</div>";	
            echo "</div>";
            
            echo "<div class=\"form-group\">";
                echo "<label class=\"control-label col-sm-3\" for=\"facebook\">Facebook</label>";
                echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"facebook\" name=\"facebook\" value='$facebook' readonly placeholder=\"facebook link\"/>";
                echo "</div>";	
            echo "</div>";
            
            echo "<div class=\"form-group\">";
                echo "<label class=\"control-label col-sm-3\" for=\"twitter\">Twitter</label>";
                echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"twitter\" name=\"twitter\" value='$twitter' readonly placeholder=\"twitter link\"/>";
                echo "</div>";	
            echo "</div>";
    echo "</section>";
 echo "</section>";	


    
    
 }
 function verwerkFunctie() {
    global $connection;
    global $functieArray;
   
    $checkFunctie = array();
    if (!empty($_POST['functie_List'])) {
        foreach ($_POST['functie_List'] as $selected){            
            $ervaring = bepaalErvaring($selected);
            array_push($checkFunctie, $selected);
        }
    }
        
    for ($i=1; $i<=10; $i++){
        $functieIndex = array_search($i, array_column($functieArray, 0));
        if (is_numeric($functieIndex)){
            //functie is gevonden, dus aanwezig in database
            $checkIndex = array_search($i, $checkFunctie);
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt --> Delete database entry
                $sql = mysqli_query($connection, "DELETE FROM user_functie WHERE `user_id`='".$_SESSION["user_id"]."' 
                                                 AND `functie_id` = '".$i."'");
            }
            else {
                //functie is aangevinkt, controle of ervaring gewijzigd is
                $ervaring = bepaalErvaring($checkFunctie[$checkIndex]);
                if ($functieArray[$functieIndex][1] <> $ervaring){
                    //ervaring is gewijzigd
                    $sql = mysqli_query($connection, "UPDATE user_functie SET `ervaring` = '".$ervaring."' WHERE `user_id`='".$_SESSION["user_id"]."' AND `functie_id` = '".$i."'");
                }
                else {
                    //ervaring is niet gewijzigd, geen query draaien
                }
            }               
        }
        else {
            //functie zit niet in database
            $checkIndex = array_search($i, $checkFunctie);
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt
                //$sql = mysqli_query($connection, "DELETE FROM user_functie WHERE `user_id`='".$_SESSION["user_id"]."' 
                //                                 AND `functie_id` = '".$i."'");
            }
            else {
                 //functie is aangevinkt
                $ervaring = bepaalErvaring($checkFunctie[$checkIndex]);
                $functieId = $checkFunctie[$checkIndex];
               $sql = mysqli_query($connection, "INSERT INTO user_functie (`user_id`,`functie_id`, `ervaring`)
                        VALUES ('".$_SESSION['user_id']."', '".$functieId."', '".$ervaring."')");
            }       
            
        }
    };
            
    /*if (!empty($_POST['functie_List'])) {
        foreach ($_POST['functie_List'] as $selected){
            $ervaring = bepaalErvaring($selected);
            $sql = mysqli_query($connection, "INSERT INTO user_functie (`user_id`,`functie_id`, `ervaring`)
                        VALUES ('".$_SESSION['user_id']."', '".$selected."', '".$ervaring."')");
             if (mysqli_affected_rows($connection) == 0)
                {
                    $insertStatus = FALSE;
                } 
                else
                {
                    $insertStatus = TRUE;
                }
        }
    }
    else {
        $insertStatus = FALSE;
    } */   
 }
 
 function bepaalErvaring($selected) {
     switch ($selected) {
        case 1 :
            return $_POST['ervaring1'];
            break;
        case 2 :
            return $_POST['ervaring2'];
            break;
        case 3 :
            return $_POST['ervaring3'];
            break;
        case 4 :
            return $_POST['ervaring4'];
            break;
        case 5 :
            return $_POST['ervaring5'];
            break;
        case 6 :
            return $_POST['ervaring6'];
            break;
        case 7 :
            return $_POST['ervaring7'];
            break;
        case 8 :
            return $_POST['ervaring8'];
            break;
        case 9 :
            return $_POST['ervaring9'];
            break;
        case 10 :
            return $_POST['ervaring10'];
            break;
        default:
            break;
    }
 };
 
 function toonFuncties(){
    global $connection;
    global $functieArray;
    //$functieArray = array();
    
    $aantal = count($functieArray);
    $checked = array();
    $ervaring = array();
    for ($i = 1; $i <= 10; $i++){
        $functieZoek = array_search($i, array_column($functieArray, 0));
        if (IS_NUMERIC($functieZoek)){
            array_push($checked, "checked='checked'");
            array_push($ervaring, $functieArray[$functieZoek][1]);
        }
        else {
            array_push($checked, "");
            array_push($ervaring, 0);
        };
    };
    
    echo "<section id=\"functies\">";
        echo "<div class=\"kop\">";
                echo "<p>Overzicht functie(s) en werkervaring (op een schaal van 1 tot 10)";
        echo "</div>";

        echo "<div class=\"functieVak1\">";
            echo "<div class=\"form-group\">";
                echo "<label class=\"col-sm-7 text-left\"><input id=\"functieCheck1\" type=\"checkbox\"  name=\"functie_List[]\" value=1 $checked[0]  > C# developer</label>";
                //echo "<div  id=\"ervaringSlider1\" class=\"ervaringSlider col-sm-5\">";
                    //echo "<input id=\"ervaring1\" data-slider-id=\"ervaringSlider1\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=$ervaring[0]  width=\"5px\" name=\"ervaring1\" tooltip=\"hide\" size=\"5\"/>";		
                    echo "<div>";
                            echo "<span  id=\"ex1CurrentSliderValLabel\">ervaringlevel: <span id=\"ex1SliderVal\">$ervaring[0]</span></span>";
                    echo "</div>";	
                //echo "</div>";
            echo "</div>";

            echo "<div class=\"form-group\">";
                echo "<label class=\"divSlider col-sm-7 text-left\"><input id=\"functieCheck2\" type=\"checkbox\"  name=\"functie_List[]\" value=2 $checked[1] > .NET developer</label>";
                //echo "<div id=\"ervaringSlider2\" class=\"ervaringSlider col-sm-5\">";
                   // echo "<input id=\"ervaring2\" data-slider-id=\"ervaringSlider2\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=$ervaring[1] name=\"ervaring2\" tooltip=\"always\"/>";		
                    echo "<div>";
                            echo "<span id=\"ex2CurrentSliderValLabel\">ervaringlevel: <span id=\"ex2SliderVal\">$ervaring[1]</span></span>";
                    echo "</div>";	
                //echo "</div>";
            echo "</div>";

            echo "<div class=\"form-group\">";
                echo "<label class=\"col-sm-7 text-left\"><input id=\"functieCheck3\" type=\"checkbox\" name=\"functie_List[]\" value=3 $checked[2]> Front-end developer</label>";
                //echo "<div  id=\"ervaringSlider3\" class=\"ervaringSlider col-sm-5\">";
                   // echo "<input id=\"ervaring3\" data-slider-id=\"ervaringSlider3\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=$ervaring[2] name=\"ervaring3\" tooltip=\"always\"/>";
                    echo "<div>";
                        echo "<span id=\"ex3CurrentSliderValLabel\">ervaringlevel: <span id=\"ex3SliderVal\">$ervaring[2]</span></span>";
                    echo "</div>";	
               // echo "</div>";
            echo "</div>";

            echo "<div class=\"form-group\">";                            
                echo "<label class=\"col-sm-7 text-left\"><input id=\"functieCheck4\" type=\"checkbox\" name=\"functie_List[]\" value=4 $checked[3]> Back-end developer</label>";
                //echo "<div id=\"ervaringSlider4\" class=\"ervaringSlider col-sm-5\">";
                  //  echo "<input id=\"ervaring4\" data-slider-id=\"ervaringSlider4\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=$ervaring[3] name=\"ervaring4\" tooltip=\"always\"/>";	    
                    echo "<div>";
                        echo "<span id=\"ex4CurrentSliderValLabel\">ervaringlevel: <span id=\"ex4SliderVal\">$ervaring[3]</span></span>";
                    echo "</div>";
                //echo "</div>";
            echo "</div>";

            echo "<div class=\"form-group\">";
                echo "<label class=\"divSlider col-sm-7 text-left\"><input id=\"functieCheck5\" type=\"checkbox\"  name=\"functie_List[]\" value=5 $checked[4]> Java developer</label>";
               // echo "<div id=\"ervaringSlider5\" class=\"ervaringSlider col-sm-5\">";
                   // echo "<input  id=\"ervaring5\" data-slider-id=\"ervaringSlider5\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-value=$ervaring[4] name=\"ervaring5\" tooltip=\"always\"/>";		
                    echo "<div>";
                        echo "<span id=\"ex5CurrentSliderValLabel\">ervaringlevel: <span id=\"ex5SliderVal\">$ervaring[4]</span></span>";
                    echo "</div>";
              //  echo "</div>";
            echo "</div>";
        echo "</div>";

        echo "<div class=\"functieVak2\">";
            echo "<div class=\"form-group\">";
                    echo "<label class=\"col-sm-7 text-left\"><input id=\"functieCheck6\" type=\"checkbox\"  name=\"functie_List[]\" value=6 $checked[5]> Project manager</label>";
                    //echo "<div id=\"ervaringSlider6\" class=\"ervaringSlider col-sm-5\">";
                       // echo "<input id=\"ervaring6\" data-slider-id=\"ervaringSlider6\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=$ervaring[5] name=\"ervaring6\" tooltip=\"always\"/>";		
                        echo "<div class=\"sliderValue\" >";
                            echo "<span id=\"ex6CurrentSliderValLabel\">ervaringlevel: <span id=\"ex6SliderVal\">$ervaring[5]</span></span>";
                        echo "</div>";
                    //echo "</div>";
            echo "</div>";

            echo "<div class=\"form-group\">";
                echo "<label class=\"divSlider col-sm-7 text-left\"><input id=\"functieCheck7\" type=\"checkbox\"  name=\"functie_List[]\" value=7 $checked[6]> Functioneel ontwerper</label>";
               // echo "<div id=\"ervaringSlider7\" class=\"ervaringSlider col-sm-5\">";
                   // echo "<input id=\"ervaring7\" data-slider-id=\"ervaringSlider7\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=$ervaring[6] name=\"ervaring7\" tooltip=\"always\"/>";
                    echo "<div>";
                        echo "<span id=\"ex7CurrentSliderValLabel\">ervaringlevel: <span id=\"ex7SliderVal\">$ervaring[6]</span></span>";
                    echo "</div>";	
               // echo "</div>";
            echo "</div>";

            echo "<div class=\"form-group\">";
                echo "<label class=\"col-sm-7 text-left\"><input id=\"functieCheck8\" type=\"checkbox\" name=\"functie_List[]\" value=8 $checked[7]> Test coordinator</label>";
               // echo "<div  id=\"ervaringSlider8\" class=\"ervaringSlider col-sm-5\">";
                   // echo "<input id=\"ervaring8\" data-slider-id=\"ervaringSlider8\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=$ervaring[7] name=\"ervaring8\" tooltip=\"always\"/>";
                    echo "<div>";
                        echo "<span id=\"ex8CurrentSliderValLabel\">ervaringlevel: <span id=\"ex8SliderVal\">$ervaring[7]</span></span>";
                    echo "</div>";	
                //echo "</div>";
            echo "</div>";

            echo "<div class=\"form-group\">";
            echo "<label class=\"col-sm-7\"><input id=\"functieCheck9\" type=\"checkbox\" name=\"functie_List[]\" value=9 $checked[8]> Product owner</label>";
                //echo "<div id=\"ervaringSlider9\" class=\"ervaringSlider col-sm-5\">";
                   // echo "<input id=\"ervaring9\" data-slider-id=\"ervaringSlider9\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=$ervaring[8] name=\"ervaring9\" tooltip=\"always\"/>";		
                    echo "<div>";
                        echo "<span id=\"ex9CurrentSliderValLabel\">ervaringlevel: <span id=\"ex9SliderVal\">$ervaring[8]</span></span>";
                    echo "</div>";
                //echo "</div>";
            echo "</div>";

            echo "<div class=\"form-group\">";
            echo "<label class=\"divSlider col-sm-7 text-left\"><input id=\"functieCheck10\" type=\"checkbox\"  name=\"functie_List[]\" value=10 $checked[9]> Business analist</label>";
               // echo "<div id=\"ervaringSlider10\" class=\"ervaringSlider col-sm-5\">";
                  //  echo "<input  id=\"ervaring10\" data-slider-id=\"ervaringSlider10\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-value=$ervaring[9] name=\"ervaring10\"  tooltip=\"always\"/>";		
                    echo "<div>";
                        echo "<span id=\"ex10CurrentSliderValLabel\">ervaringlevel: <span id=\"ex10SliderVal\">$ervaring[9]</span></span>";                                   
                    echo "</div>";
               // echo "</div>";
            echo "</div>";
        echo "</div>";    
    echo "</section>";
 };
 
 function variableWaarde($variable){
     if (isset($_SESSION[$variable])){
         return $_SESSION[$variable];
     }
     else {
         return "\"\"";
     }
 };
 
 function toonMobielUitkering () {
    echo "<section id=\"mobielFinUitkering\">";
    $rijbewijs = variableWaarde('rijbewijs');
    if ($rijbewijs){
        $checkRijbewijs = "checked='checked'";
    }
    else {
        $checkRijbewijs = " ";
    }
    $auto = variableWaarde('auto');
    if ($auto){
        $checkAuto = "checked='checked'";
    }
    else {
        $checkAuto = " ";
    }
    
    $salaris = variableWaarde('salaris');
    $uitkering = variableWaarde('uitkering');
    
    $geldigtot = variableWaarde('uitkeringGeldigTot');
    /*f ($uitkeringGeldigTot != " "){
        $date = new DateTime($uitkeringGeldigTot);
        $geldigtot = date_format($date, 'M-Y');
    }*/
    $uitkeringGeldigTot = $_SESSION['uitkeringGeldigTot'];
  
    $selectWW; $selectWajong; $selectIOAW; $selectBijstand = "";
    switch ($uitkering) {
        case 'WW' : 
            $selectWW = "selected";
            break;
        case 'Wajong' : 
            $selectWajong = "selected";
            break;
        case 'IOAW' : 
            $selectIOAW = "selected";
            break;
        case 'Bijstand' : 
            $selectBijstand = "selected";
            break;
        case 'Geen ZZP' : 
            $selectGeenZzp = "selected";
            break;
        case 'Geen Bijstand' : 
            $selectGeenBijstand = "selected";
            break;
    }


    echo "<section id=\"mobielFinancieel\">";
        echo "<div id =\"rijbewijs\" class=\"form-group\">";
            echo "<label class=\"col-sm-12 text-left\"><input id=\"rijbewijsCheck\" type=\"checkbox\" value=$rijbewijs  name=\"rijbewijs\" $checkRijbewijs > Rijbewijs</label>";					
        echo "</div>";
        echo "<div class=\"form-group\" id=\"auto\">";
            echo "<label class=\"col-sm-12 text-left\"><input id=\"autoCheck\" type=\"checkbox\" value=$auto name=\"auto\" $checkAuto> Auto</label>";					
        echo "</div>";
        echo "<div class=\"form-group\" id=\"financieel\">";
            echo "<label class=\"col-sm-5\" for=\"salaris\">Salaris indicatie</label>";
            echo "<div class=\"col-sm-5\">";
                echo "<input type=\"text\" class=\"form-control input-sm\" id=\"salaris\" name=\"salaris\" value=$salaris>";	
            echo "</div>";	
        echo "</div><br/><br/>";
        echo "<div class=\"form-group\" id=\"uitkering\">";
            echo "<label class=\"col-sm-5 \" for=\"uitkering\">Soort uitkering</label>";
            echo "<div class=\"col-sm-4\">";
                echo "<select class=\"form-control input-sm\" name=\"uitkering\" value=$uitkering>";
                    echo   "<option value=\"WW\" $selectWW>WW</option>
                            <option value=\"IOAW\" $selectIOAW>IOAW</option>
                            <option value=\"Wajong\" $selectWajong>Wajong</option>
                            <option value=\"WAO\" $selectBijstand>WAO</option>
                            <option value=\"Geen ZZP\" $selectGeenZzp>Geen ZZP'er</option>
                            <option value=\"Geen Bijstand\" $selectGeenBijstand>Geen Bijstand</option>";
                echo "</select>";
            echo "</div>";	
        echo "</div><br/><br/>";
        echo "<div class=\"form-group\" id=\"ww\">";
            echo "<label class=\"col-sm-5\" for=\"salaristkeringGeldigTot\">Uitkering geldig tot</label>";
            echo "<div class=\"col-sm-4\">";
                echo "<input type=\"text\" class=\"form-control input-sm\" id=\"salaris\" name=\"uitkeringGeldigTot\" value=$uitkeringGeldigTot placeholder=\"mm-jjjj\" />";
            echo "</div>";	
        echo "</div>";
    echo "</section>";	

 }
 
  function bepaalSectorErvaring($selected) {
     switch ($selected) {
        case 1 :
            return $_POST['sectorErvaring0'];
            break;
        case 2 :
            return $_POST['sectorErvaring1'];
            break;
        case 3 :
            return $_POST['sectorErvaring2'];
            break;
        case 4 :
            return $_POST['sectorErvaring3'];
            break;
        
        default:
            break;
    }
 }; 
 
 
 function toonSector() {
    global $connection;
    global $sectorArray;// de sectorArray wordt in kandidaat.php gemaakt en bestaat uit een collectie van de sector id's voor de user in de huidige sessie
    global $bedrijfArray;
    global $gewensteSectorArray;
    global $bedrijfGewerktArray;
    
        $checkedGewensteSector = array();
        for ($i = 1; $i <= 4; $i++){//de sector id's zijn 1 t/m 4
            $gewensteSectorIndex = array_search($i, array_column($gewensteSectorArray, 0));//verzamel de sector id's van de huidige user en stop ze in de array $sectorIndex
            if (IS_NUMERIC($gewensteSectorIndex)){
                array_push($checkedGewensteSector, "checked='checked'");        
            }
            else {
                array_push($checkedGewensteSector, "");
            };
        };
    

        $checkedSector = array();
        $sectorErvaring = array();
        for ($i = 1; $i <= 4; $i++){//de sector id's zijn 1 t/m 4
            $sectorIndex = array_search($i, array_column($sectorArray, 0));//verzamel de sector id's van de huidige user en stop ze in de array $sectorIndex
            if (IS_NUMERIC($sectorIndex)){
                array_push($checkedSector, "checked='checked'");        
                array_push($sectorErvaring, $sectorArray[$sectorIndex][1]);
            }
            else {
                array_push($checkedSector, "");
                array_push($sectorErvaring, 0);
            };
        };

     $checkedBedrijf = array();
        for ($i = 1; $i <= 4; $i++){
            $bedrijfIndex = array_search($i, array_column($bedrijfArray, 0));
            if (IS_NUMERIC($bedrijfIndex)){
                array_push($checkedBedrijf, "checked='checked'");
            }
            else {
                array_push($checkedBedrijf, "");
            };
        };   
        
       $checkedBedrijfGewerkt = array();

        for ($i = 1; $i <= 4; $i++){
            $bedrijfGewerktIndex = array_search($i, array_column($bedrijfGewerktArray, 0));
            if (IS_NUMERIC($bedrijfGewerktIndex)){
                array_push($checkedBedrijfGewerkt, "checked='checked'");
            }
            else {
                array_push($checkedBedrijfGewerkt, "");
            };
        };
 
        
              
echo "<section id=\"sectorwerk\">";
     echo "<div id=\"sector\">";
            echo "<div class=\"kop\">";
                    echo "<p>Vink de sector(s) aan waar je in werkzaam bent geweest en geef op hoeveel jaren</p>";
            echo "</div>";
            echo "<label class=\"checkbox-inline\">";
                    echo "<input type=\"checkbox\" value=1  name=\"sector_List[]\" $checkedSector[0]>ICT ";
                    echo "<input type=\"text\" id=\"sectorErvaring0\" name=\"sectorErvaring0\" value=$sectorErvaring[0]jaren_gewerkt readonly>";	
            echo "</label>";
            echo "<div class=\"subKopRechts\">";
                    echo "<label class=\"checkbox-inline extra1\">";
                            echo "<input type=\"checkbox\" value=2 name=\"sector_List[]\" $checkedSector[1]>Zorg";
                            echo "<input type=\"text\" id=\"sectorErvaring1\" name=\"sectorErvaring1\" value=$sectorErvaring[1]jaren_gewerkt readonly>";	
                    echo "</label>";
            echo "</div>";
            echo "<label class=\"checkbox-inline\">";
                    echo "<input type=\"checkbox\" value=3 name=\"sector_List[]\" $checkedSector[2]>Industrie";
                    echo "<input type=\"text\" id=\"sectorErvaring2\" name=\"sectorErvaring2\" value=$sectorErvaring[2]jaren_gewerkt readonly>";	
            echo "</label>";
            echo "<div class=\"subKopRechts\">";
                    echo "<label class=\"checkbox-inline extra1\">";
                            echo "<input type=\"checkbox\" value=4 name=\"sector_List[]\" $checkedSector[3]>Retail";
                            echo "<input type=\"text\" id=\"sectorErvaring3\" name=\"sectorErvaring3\" value=$sectorErvaring[3]jaren_gewerkt readonly>";
                    //echo "<input type=\"text\" class=\"form-control input-sm\" id=\"sectorErvaring3\" name=\"sectorErvaring3\" value=$sectorErvaring[3]>";	
                    echo "</label>";
            echo "</div>";
      echo "</div>";
      echo "<div class=\"kop\">"; 
                 echo "<p>Gemiddelde grootte van het bedrijven waar gewerkt is</p>";
            echo "<label class=\"checkbox-inline\">";
                    echo "<input type=\"checkbox\" value=1 readonly  name=\"bedrijfGewerkt_List[]\" $checkedBedrijfGewerkt[0]>micro (< 10)";
            echo "</label>";
            echo "<label class=\"checkbox-inline\">";
                    echo "<input type=\"checkbox\" value=2 readonly  name=\"bedrijfGewerkt_List[]\" $checkedBedrijfGewerkt[1]>klein (<50)";
            echo "</label>";
            echo "<label class=\"checkbox-inline\">";
                    echo "<input type=\"checkbox\" value=3 readonly name=\"bedrijfGewerkt_List[]\" $checkedBedrijfGewerkt[2]>middelgroot (< 250)";
            echo "</label>";
            echo "<label class=\"checkbox-inline\">";
                    echo "<input type=\"checkbox\" value=4 readonly name=\"bedrijfGewerkt_List[]\" $checkedBedrijfGewerkt[3]>groot (> 250)";
            echo "</label>";
        echo "</div>";   
echo "</div>"; 

echo "<section id=\"sectorGewenst\">";
        echo "<div id=\"bedrijf\">";
            echo "<div class=\"kop\">";
                    echo "<p>Gewenste ICT-SECTOR</p>";
            echo "</div>";
             echo "<label class=\"checkbox-inline\">";
                    echo "<input type=\"checkbox\" value=1  name=\"gewenste_Sector_List[]\" $checkedGewensteSector[0]>ICT ";	
            echo "</label>";
            echo "<label class=\"checkbox-inline\">";
                    echo "<input type=\"checkbox\" value=2 name=\"gewenste_Sector_List[]\" $checkedGewensteSector[1]>Zorg";	
            echo "</label>";
            echo "<label class=\"checkbox-inline\">";
                    echo "<input type=\"checkbox\" value=3 name=\"gewenste_Sector_List[]\" $checkedGewensteSector[2]>Industrie";	
            echo "</label>";
            echo "<label class=\"checkbox-inline\">";
                    echo "<input type=\"checkbox\" value=4 name=\"gewenste_Sector_List[]\" $checkedGewensteSector[3]>Retail";	
            echo "</label>";
        echo "</div>"; 
   //echo"<hr>";     
        echo "<div class=\"kop\">"; 
                 echo "<p>Gewenste grootte van het bedrijf</p>";
            echo "<label class=\"checkbox-inline\">";
                    echo "<input type=\"checkbox\" value=1 name=\"bedrijf_List[]\" $checkedBedrijf[0]>micro (< 10)";
            echo "</label>";
            echo "<label class=\"checkbox-inline\">";
                    echo "<input type=\"checkbox\" value=2 name=\"bedrijf_List[]\" $checkedBedrijf[1]>klein (<50)";
            echo "</label>";
            echo "<label class=\"checkbox-inline\">";
                    echo "<input type=\"checkbox\" value=3 name=\"bedrijf_List[]\" $checkedBedrijf[2]>middelgroot (< 250)";
            echo "</label>";
            echo "<label class=\"checkbox-inline\">";
                    echo "<input type=\"checkbox\" value=4 name=\"bedrijf_List[]\" $checkedBedrijf[3]>groot (> 250)";
            echo "</label>";
        echo "</div>";

        echo "</section>";
  echo "</section>"; 
 }; 
 
 function toonRegio(){
    global $regioArray;
    
    echo "<section id=\"regio\">";
        $checkedRegio = array();

        $reisafstand = variableWaarde('reisafstand');
        
        for ($i = 1; $i <= 16; $i++){
            $regioIndex = array_search($i, array_column($regioArray, 0));
            if (IS_NUMERIC($regioIndex)){
                array_push($checkedRegio, "checked='checked'");
            }
            else {
                array_push($checkedRegio, "");
            };
        };

        echo "<section class=\"afstand\">";
            echo "<div class=\"col-sm-12 kop\">";
                echo "<p>Geef de maximale reisafstand</p>";
            echo "</div>";	
            echo "<div class=\"form-group\">";
                echo "<label class=\"col-sm-3\" for=\"reisafstand\">Reisafstand</label>";
                echo "<div class=\"col-sm-3\">";
                    echo "<input type=\"text\" class=\"form-control input-sm\" id=\"reisafstand\" name=\"reisafstand\" value=$reisafstand placeholder=\"in km\" />";
                echo "</div>";
            echo "</div>";	
        echo "</section><br/><br/>";

        echo "<section class=\"plaatspref\">";
            echo "<div class=\"col-sm-12 kop\">";
                    echo "<p>Vink de gewenste regio's aan</p>";
            echo "</div>";
            echo "<div class=\"form-group\">";
                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=1 $checkedRegio[0]> Noord-Holland";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=5 $checkedRegio[4]> Limburg";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=9 $checkedRegio[8]> Flevoland";
                echo "</label>";
                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=13 $checkedRegio[12]> Amsterdam e.o.";
                echo "</label>";
            echo "</div>";
            echo "<div class=\"form-group\">";
                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=2 $checkedRegio[1]> Zuid-Holland";
                echo "</label>";

                echo "<label class=\"col-sm-3\"\>";
                        echo "<input type=\"checkbox\" name=\"regio_List[]\" value=6 $checkedRegio[5]> Gelderland";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=10 $checkedRegio[9]> Drenthe";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=14 $checkedRegio[13]> Rotterdam";
                echo "</label>";
            echo "</div>";
            echo "<div class=\"form-group\">";
                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=3 $checkedRegio[2]> Zeeland";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=7 $checkedRegio[6]> Overijssel";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=11 $checkedRegio[10]> Groningen";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=15 $checkedRegio[14]> Utrecht";
                echo "</label>";
            echo "</div>";
            echo "<div class=\"form-group\">";
                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=4 $checkedRegio[3]> Noord-Brabant";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=8 $checkedRegio[7]> Utrecht";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=12 $checkedRegio[11]> Frieland";
                echo "</label>";

                echo "<label class=\"col-sm-3 text-left\">";
                        echo "<input  type=\"checkbox\" name=\"regio_List[]\" value=16 $checkedRegio[15]> Eindhoven";
                echo "</label>";
            echo "</div>";
        echo "</section>";
    echo "</section>";
 };
 
 function toonOpmerkingen() {
    //$opmerking = $_SESSION['opmerkingen']; 
    
    echo "<section id=\"opmerkingSection\">";
        echo "<div class=\"kop\">";
                echo "<p>Opmerkingen</p>";
        echo "</div>";	
        echo "<div class=\"col-sm-6\">";
                $opmerking = variableWaarde('opmerking');
                
                echo "<textarea class=\"form-control\"  name=\"opmerking\"  rows=\"5\">$opmerking	</textarea>";									 
        echo "</div>";	
        echo "<br>";
    echo "</section>";
 };
  
 function verwerkRegio() {
    global $connection;
    global $regioArray;
   
    $checkRegio = array();
    if (!empty($_POST['regio_List'])) {
        foreach ($_POST['regio_List'] as $selected){            
            array_push($checkRegio, $selected);
        }
    }
    for ($i=1; $i<=16; $i++){
        $regioIndex = array_search($i, array_column($regioArray, 0));
        if (is_numeric($regioIndex)){
            //functie is gevonden, dus aanwezig in database
            $checkIndex = array_search($i, $checkRegio);
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt --> Delete database entry
                $sql = mysqli_query($connection, "DELETE FROM user_regio WHERE `user_id`='".$_SESSION["user_id"]."' 
                                                 AND `regio_id` = '".$i."'");
            }               
        }
        else {
            //functie zit niet in database
            $checkIndex = array_search($i, $checkRegio);
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt
                //$sql = mysqli_query($connection, "DELETE FROM user_functie WHERE `user_id`='".$_SESSION["user_id"]."' 
                //                                 AND `functie_id` = '".$i."'");
            }
            else {
                 //functie is aangevinkt
                
                $regioId = $checkRegio[$checkIndex];
     
               $sql = mysqli_query($connection, "INSERT INTO user_regio (`user_id`,`regio_id`)
                        VALUES ('".$_SESSION['user_id']."', '".$regioId."')");
            }             
        }
    }
 }; 
 
 function verwerkSector() {
    global $connection;
    global $sectorArray;
   
    $checkSector = array();
    if (!empty($_POST['sector_List'])) {
        foreach ($_POST['sector_List'] as $selected){            
            array_push($checkSector, $selected);
        }
    }
        
    for ($i=1; $i<=4; $i++){
        $sectorIndex = array_search($i, array_column($sectorArray, 0));
        if (is_numeric($sectorIndex)){
            //functie is gevonden, dus aanwezig in database
            $checkIndex = array_search($i, $checkSector);
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt --> Delete database entry
                $sql = mysqli_query($connection, "DELETE FROM user_sector WHERE `user_id`='".$_SESSION["user_id"]."' 
                                                 AND `sector_id` = '".$i."'");
            }               
        }
        else {
            //functie zit niet in database
            $checkIndex = array_search($i, $checkSector);
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt
                //$sql = mysqli_query($connection, "DELETE FROM user_functie WHERE `user_id`='".$_SESSION["user_id"]."' 
                //                                 AND `functie_id` = '".$i."'");
            }
            else {
                 //functie is aangevinkt
                $sectorId = $checkSector[$checkIndex];
               $sql = mysqli_query($connection, "INSERT INTO user_sector (`user_id`,`sector_id`)
                        VALUES ('".$_SESSION['user_id']."', '".$sectorId."')");
            }             
        }
    }
 };
 
 function verwerkBedrijf() {
    global $connection;
    global $bedrijfArray;
   
    $checkBedrijf = array();
    if (!empty($_POST['bedrijf_List'])) {
        foreach ($_POST['bedrijf_List'] as $selected){            
            array_push($checkBedrijf, $selected);
        }
    }
        
    for ($i=1; $i<=16; $i++){
        $bedrijfIndex = array_search($i, array_column($bedrijfArray, 0));
        if (is_numeric($bedrijfIndex)){
            //functie is gevonden, dus aanwezig in database
            $checkIndex = array_search($i, $checkBedrijf);
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt --> Delete database entry
                $sql = mysqli_query($connection, "DELETE FROM user_bedrijf WHERE `user_id`='".$_SESSION["user_id"]."' 
                                                 AND `bedrijf_id` = '".$i."'");
            }               
        }
        else {
            //functie zit niet in database
            $checkIndex = array_search($i, $checkBedrijf);
            if (!is_numeric($checkIndex)){
                //functie is niet aangevinkt
                //$sql = mysqli_query($connection, "DELETE FROM user_functie WHERE `user_id`='".$_SESSION["user_id"]."' 
                //                                 AND `functie_id` = '".$i."'");
            }
            else {
                 //functie is aangevinkt
                $bedrijfId = $checkBedrijf[$checkIndex];
               $sql = mysqli_query($connection, "INSERT INTO user_bedrijf (`user_id`,`bedrijf_id`)
                        VALUES ('".$_SESSION['user_id']."', '".$bedrijfId."')");
            }             
        }
    }
 };
 
 function verwerkUser() {
     global $connection;
        $user_id = $_SESSION['kandidaat_id'];
        
        if(isSet($_POST['motivatie'])){
            $motivatie = $_POST['motivatie'];
        }
        else {
            $motivatie = $_SESSION['motivatie'];
        }
      /*  $telefoon = checkPost('telefoon');        
        $voornaam = checkPost('voornaam');
        $tussenvoegsel = checkPost('tussenvoegsel');
        $achternaam = checkPost('achternaam');
        $straat = checkPost('straat');
        $huisnummer = checkPost('huisnummer');
        $toevoeging = checkPost('toevoeging');
        $postcode = checkPost('postcode');
        $woonplaats = checkPost('plaats');
        $gebdat = checkPost('geb-datum');
        $gebdat = "'".$gebdat."'01";
        $foto = $_SESSION['foto'];
        $cv = $_SESSION['cv'];
        $email = checkPost('email');
        $salaris = checkPost('salaris');
        $uitkering = checkPost('uitkering');
        $uitkeringGeldigTot = checkPost('uitkeringGeldigTot'); 
        $rijbewijs = checkPost('rijbewijs');
        $auto = checkPost('auto');
        $reisafstand = checkPost('reisafstand');
        $linkedIn = checkPost('linkedIn');
        $facebook = checkPost('facebook');
        $twitter = checkPost('twitter');
        $opmerking = checkPost('opmerking');*/
        
        $sql = mysqli_query($connection, "UPDATE `user` SET 
                        `motivatie` =   '".$motivatie."'
                   
                         WHERE `user_id` = '".$user_id."'"); 

        if (mysqli_affected_rows($connection) == -1){
            echo mysqli_error($connection);
        }
};
 
 function checkPost($post){
     if (isset($_POST[$post])){
         $_SESSION[$post] = $_POST[$post];
         return $_POST[$post];
         
     }
     else {
         return $_SESSION[$post];
     }    
 }
 
//experimentele functie
 /*   function globalimageupload()
    {
        //Illuminate\Support\Facades\Input;
        global $path;
        $file = Input::file('image');
        if (Input::file('image'))
        {
            $valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
            $max_size = 2000 * 1024; // max file size (200kb)
            $ext = $file->guessClientExtension();
            $size = $file->getClientSize();
            if (in_array($ext, $valid_exts) AND $size < $max_size)
            {
                $image=Input::file('image');
                $destinationPath = $path."/assets/images";
                $num_unique = md5(uniqid() . time());
                $fileName=$num_unique.'.'.$ext;
                Input::file('image')->move($destinationPath,$fileName);
                $desPathimg=public_path()."assets/images/".$fileName;
                $desPath=$fileName;
                return HTML::image('assets/images/'.$fileName,'photo', array( 'width' => 128, 'id'=> 'po', 'name'=> 'po', 'height' => 128 )).'<input type="hidden" name="imagetextbox" id="imagetextbox"  value="'.$desPath.'">';  
            }
            else
            {
                return 'Check the Extension and file size';
            }
        }
        else
        {   
                  return "Please upload any Image"; 
        }
    }  */
    //einde experimentele functie 



 //werkende versie bij Thijs
 function verwerkFoto() {
     global $connection;
     // Check if image file is a actual image or fake image
    error_reporting(0);

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }
    error_reporting(E_ALL);

    if ($uploadOk == 1) {
        $target_imgdir = "C:/xampp/htdocs/humanic/assets/images/";
        $img_id = uniqid();


        $target_imgfile = $target_imgdir .basename($_FILES["foto"]["name"]);
        $imageFileType = pathinfo($target_imgfile,PATHINFO_EXTENSION);
        // Check if file already exists
        if ($_SESSION['foto']) {
            $_FILES["foto"]["name"] = $img_id. "." . $imageFileType;// ik geef de foto de logginnaam van de user
            //$_FILES["foto"]["name"] = $_SESSION['user_loginnaam'];
            $target_imgfile = $target_imgdir .basename($_FILES["foto"]["name"]);
        }
        else {
            $_FILES["foto"]["name"] = $img_id. "." . $imageFileType;
            //$_FILES["foto"]["name"] = $img_id . "." . $imageFileType;
            $target_imgfile = $target_imgdir .basename($_FILES["foto"]["name"]);
        }   



    // Check file size
        if ($_FILES["foto"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    // Allow certain file formats

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

    // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_imgfile)) {
    //            echo "The file ". basename( $_FILES["foto"]["name"]). " has been uploaded.";
                $_SESSION['foto'] = basename($_FILES["foto"]["name"]);
                $sql = mysqli_query($connection, "UPDATE `user` SET `foto` = '".$_SESSION['cv']."'
                                                WHERE `user_id` = '".$_SESSION['foto']."'");
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
 }

function verwerkCV ()
 {
        if(isSet($_POST["submit"]) && isSet($_FILES['cv']) && $_FILES['cv'] != "")// Testen op lege FILES variabelen schijnt niet te werken, ze blijken nl nooit 'leeg' te zijn!
             {
                     global $connection;
                    $uploadOk = 1;
    
                    $target_dir = "C:/xampp/htdocs/humanic/assets/user-cv/";
                    $img_id = uniqid();

                    $target_file = $target_dir .basename($_FILES["cv"]["name"]);
                    $nwCvFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
                    //echo "de naam van de sessie cv: '".$_SESSION['cv']."'<br/>";
                    //echo "de naam van de nieuwe cv: '".$target_file."'<br/>";

                    $extensionPos = strripos($_SESSION['cv'], ".");// achterhaal op welke positie de punt voorkomt in de naam, tellen begint vanaf positie 0
                    //echo "de positie van de punt in de cv naam: '".$extensionPos."'<br/>";
    
                    $strLen = strlen($_SESSION['cv']);// de lengte van de cv bepalen
                    $cvFileType = substr($_SESSION['cv'], $extensionPos + 1, $strLen);//echo "cvFileType: '".$cvFileType."'<br/>";//het deel van de cv pakken vanaf de punt tot het eind van de cv
                    $strLenNwCvFileType = strlen($nwCvFileType);//echo "lengte van de neuwe extensie: '".$strLenNwCvFileType."'<br/>";
                    // Check if file already exists
                    if ($_SESSION['cv'] != ""  &&  $_FILES['cv'] !="")
                        {
                    //controle file type, niet gelijk dan file type vervangen
                                 if ($nwCvFileType != $cvFileType && $strLenNwCvFileType > 0)// als de extensie van de sessie cv verschilt van de extensie nieuw opgegeven cv en de extensie van de nieuwe cv gorter is dan 0 tekens
                                     {
                                            $_FILES["cv"]["name"] = substr_replace($_SESSION['cv'],$nwCvFileType, $extensionPos + 1);//dan de naam van de sessei cv 
                                            $_SESSION['cv'] = $_FILES["cv"]["name"] ;// behouden en alleen de andere extensie aan plakken en dit weer toekennen aan de sessie cv
                                            //echo "extensie verschilt of er is geen nieuwe cv geupload: '".$_SESSION['cv']."'";
                                        }
                                else 
                                     {
                                        $_FILES["cv"]["name"] = $_SESSION['cv']; //echo "extensie hetzelfde: '".$_FILES["cv"]["name"]."'";
                                       }
                                $target_file = $target_dir .basename($_FILES["cv"]["name"]);
                        }
                    elseif ($_SESSION['cv'] != ""  &&  !isSet($_FILES['cv'])) 
                        {
                              $_FILES["cv"]["name"] = $_SESSION['cv'].$cvFileType; //echo "geen nieuwe cv geplaats, dus huidige is: '".$_FILES["cv"]["name"]."'";
                              $_SESSION['cv'] = $_FILES["cv"]["name"];
                        }
                    else
                        {
                                $_FILES["cv"]["name"] = $img_id . "." . $nwCvFileType;//echo "er was nog geen cv, nu wel: '".$_FILES["cv"]["name"]."'";
                                //$target_file = $target_dir .basename($_FILES["cv"]["name"]);
                        }
                        
                        $target_file = $target_dir .basename($_FILES["cv"]["name"]);

                    // Check file size
    if($_FILES["cv"]["size"] > 0)
            {
                    if ($_FILES["cv"]["size"] > 500000) 
                            {
                                echo "Sorry, your file is too large.";
                                $uploadOk = 0;
                            }
                    // Allow certain file formats

                     if($nwCvFileType != "doc" && $nwCvFileType != "docx" && $nwCvFileType != "txt" && $nwCvFileType != "pdf") 
                            {
                                  echo "Sorry, only DOC, DOCX, PDF and TXT files are allowed.";
                                  $uploadOk = 0;
                            }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) 
                            {
                                echo "Sorry, your file was not uploaded.";
                            
                            } 
                    else // if everything is ok, try to upload file
                            {
                                    if (move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file)) 
                                            {

                                                    $_SESSION['cv'] = basename($_FILES["cv"]["name"]);
                                                    /*$sql = mysqli_query($connection, "UPDATE `user` SET `cv` = '".$_SESSION['cv']."'
                                                    WHERE `user_id` = '".$_SESSION['user_id']."'");
                                                     if (mysqli_affected_rows($connection) == -1){
                                                    echo mysqli_error($connection);
                                                    }*/
            
                                               } 
                                    else 
                                            {
                                                    echo "Sorry, there was an error uploading your file.";
                                            }
                            } 
             }
        }
        
 }