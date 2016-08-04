<?php

/*
Bezoekers Online V1
 
Dit is een eenvoudig scriptje om je online bezoekers te tonen,
in tabel waarin wat meer informatie staat, of gewoon alleen het aantal
bezoekers online
 
De bijbehorende tabel:
-------------------------------------
 
CREATE TABLE IF NOT EXISTS`online` (
`id` int(11) auto_increment,
`ip` varchar(16) default '0.0.0.0',
`locatie` varchar(255) default '',
`tijd` int(11) default '0',
PRIMARY KEY (`id`)
);
 
-------------------------------------
 
Functie declaratie:
 
OnlineLog(int $sTime)
	Deze logt de bezoekers op IP adres.
	Ook verwijderd hij bezoekers na de aangegeven tijd
	in $sTime
 
OnlineShow(int $sTime)
	Deze laat het aantal bezoekers online weergeven
 
OnlineTable(int $sTime)
	Deze functie toont een tabel met de bezoekers die
	online zijn, inclusief de pagina waar ze zijn, en
	wanneer deze actie is ondernomen
*/
 

 
function onlineLog($sTime = 300)
{
	global $connection;

	mysqli_query($connection, "DELETE FROM `online` 
	WHERE `online_tijd` < ".(time()-$sTime))
	or die(mysqli_error());
    
	$cCountSql = mysqli_query($connection, "SELECT COUNT(`online_id`)
	FROM `online` WHERE `online_ip` = '".$_SERVER['REMOTE_ADDR']."'");
//	$cCount = mysqli_result($cCountSql,0);
	$row = mysqli_fetch_row($cCountSql);
	if($row[0] == 0)
		{
		mysqli_query($connection, "INSERT INTO `online`(`user_id`, `online_ip`, `online_locatie`, `online_tijd`)
		VALUES ('".$_SESSION['user_id']."', '".$_SESSION['onlineIP']."',
		'".$_SERVER['REQUEST_URI']."',".time().")")
		or die(mysqli_error());
		}
	else
		{
		mysqli_query($connection, "UPDATE `online` SET
		`online_tijd` = ".time().",
		`online_locatie` = '".$_SERVER['REQUEST_URI']."'
		WHERE `online_ip` = '".$_SERVER['REMOTE_ADDR']."'")
		or die(mysqli_error());
		}
}
 
function onlineShow($sTime = 300)
{
	global $connection;

	$sQuery = mysqli_query($connection, "SELECT COUNT(`online_id`) FROM `online` WHERE `online_tijd` > ".(time()-$sTime));
//	$sResult = mysqli_result($sQuery,0);
	$row = mysqli_fetch_row($sQuery);
	echo ($row[0] == 1) ? 'Er is 1 bezoeker online.' : '<h3>Er zijn '.$row[0].' bezoekers online</h3>.';
        
}
 
function onlineTable($sTime = 300)
{
	global $connection;
	
	echo "<table align=\"center\">";
		echo "<tr>";
			echo "<th><b>Locatie</b></th>";
			echo "<th><b>Laatste bezoek</b></th>";
			echo "<th><b>Sinds</b></th>";
		echo "</tr>";
	
	$sSql = mysqli_query($connection, "SELECT * FROM 
	`online` WHERE `online_tijd` > ".(time()-$sTime)." 
	ORDER BY `online_tijd` DESC") or die(mysqli_error());
	while($sRow = mysqli_fetch_assoc($sSql))
		{
		
		echo "<tr>";
			echo "<td><a href=\"".$sRow['online_locatie']."\">".$sRow['online_locatie']."</a></td>";
			echo "<td> time()-".$sRow['online_tijd']." sec.</td>";
			echo "<td> date('G:i:s',".$sRow['online_tijd'].")</td>";
		echo "</tr>";
		
		}
	echo "</table>";
}

 /*       
function updateUserLaatstGezien()
       {

            $q = 'UPDATE user SET laatst_gezien = '.$time.' WHERE user_id = '.$_SESSION['user_id'].'';
            $database->query($q);
    
       } 
       
function checkUserLaatstGezien($user_id)
       {
        
            $time = time()- 300; // 5 minuten.

            $q = 'SELECT * FROM user WHERE user_id = "'.$_SESSION['user_id'].'" AND laatst_gezien > '.$time.'';
          
            $result = $database->query($q);
            
            if(mysqli_num_rows($result) != 0)
            {
            
                return 'online';
            
            }
            else
            {
            
                return 'offline';
            }
       
       
       }     */
       
       
       
       
        
?>
