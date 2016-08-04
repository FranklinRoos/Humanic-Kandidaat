<?php

function showFormModifyAccount ($naam= "",$email="")
{
     
       
        //echo "<h1>Modificeren wachtwoord</h1>";
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>";
        echo "<table>";
        echo "<tr><td>Uw login naam:</td>";
        echo "<td>".ucfirst($naam)."</td></tr>";
        echo "<tr><td>E-mailadres: </td>";
        echo "<td>".$email."</td></tr>";
        echo "<tr><td>Typ uw nieuw wachtwoord:</td>";
        echo "<td><input type='password' name='modpasswd1'</td></tr>";
        echo "<tr><td>Herhaal uw wachtwoord:</td>";
        echo "<td><input type='password' name='modpasswd2'></td></tr>";
        echo "</table>";
        echo "<input type='submit' name='modsubmit' value='veranderen'>";
        echo "</form>";
    
      
}
 
function handleModifyAccount ()
{
    global  $connection;
            
    if(md5(trim($_POST['modpasswd1']))==md5(trim($_POST['modpasswd2'])))
    {
        $sql = mysqli_query($connection, "UPDATE `user` SET `user_wachtwoord`='".md5(trim($_POST['modpasswd1']))."' WHERE `user_inlognaam`= '".$_SESSION['loginnaam']."'");
       
    }
    else
     {
       echo "Je moet wel 2x hetzelfde wachtwoord invullen";
        showFormModifyAccount ($naam,$email);
      }
   
}

function showFormTerminate()
{
        echo "<h4>U heeft besloten uw account te beindigen,ik vraag u ter bevestiging uw wachtwoord nogmaals op te geven</h4><br>";
        echo "<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>";
        echo "<table>";
        echo "<tr><td>Uw login naam:</td>";
        echo "<td>".$_SESSION['loginnaam']."</td></tr>";
        echo "<tr><td>E-mailadres: </td>";
        echo "<td>".$_SESSION['email']."</td></tr>";
        echo "<tr><td>U wachtwoord</td>";
        echo "<td><input type='password' name='termpasswd'</td></tr>";
        echo "</table>";
        echo "<input type='submit' name='termsubmit' value='Delete'>";
        echo "</form>";
    
}

function handleFormTerminate()
{
  global $connection;

    if (md5(trim($_POST['termpasswd']))==$_SESSION['passwd'])
    {
        $sql = mysqli_query($connection, "UPDATE `user` SET `user_activ`='no' WHERE `user_inlognaam`= '".$_SESSION['loginnaam']."'");
          // Unset all of the session variables.
             $_SESSION = array();
             session_destroy();   
    }
    else
    {
       echo "Het wachtwoord klopt niet";
       showFormTerminate();
    }
    
}