<?php
function overzicht()
{
    global $connection; 
    
    $user_id = $_SESSION["user_id"];//deze sessie variabele werd in de handleForm functie aangemaakt in humanic-functions.php
    $objecten = mysqli_query($connection, "SELECT * FROM user where user_id=$user_id ") or die(mysqli_error());// ik doe hier een call(query) naar de databse  in de 'user'tabel, voor 1 user
    
    if (mysqli_num_rows($objecten) == 0) 
    {
        die("<i>Nog geen users aanwezig !</i>");
    }

        $GLOBALS['path']="http://localhost:7777/humanic/";
        global $path;  
        global $imagepath;
        
        //Hier onder gebruik het formulier uit de registratie om de kandidaat gegevens te tonen, toegevoegd op zat 16juli
        while ($bericht = mysqli_fetch_object($objecten)) 
        {
            
          echo " <div class=\"container\">";
		echo "<h2>".$_SESSION["loginnaam"].", dit is een overzicht van je gegevens</h2>";
		echo "<section id=\"persoonlijke-gegevens\">";
							
						 echo "<section id=\"personalia\">";
							echo "<div class=\"kop\">";
								echo "<p>Uw naam en adres gegevens :</p>";
							echo "</div>";
	 					//	<h4>Personalia:</h4> -->
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3 text-left\" for=\"login-naam\">Loginnaam: ".$_SESSION["loginnaam"]." </label>";
								//<input type="text" class='form-control' id="login-naam" name="LoginNaam" required="required" autofocus="autofocus"/> -->
								echo "<div class=\"col-sm-9\">";
									echo "<Loginnaam : ".$_SESSION["loginnaam"]." autofocus=\"autofocus\"/>";
								echo "</div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3\" for=\"achternaam\">Achternaam *</label>";
								//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
								echo "<div class=\"col-sm-9\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"achternaam\" name=\"achterNaam\" value= ".utf8_encode($bericht->achternaam)." required=\"required\"/>";
								echo "</div>";	
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3\" for=\"tussenvoegsel\">Tussenvoegsel</label>";
								//<!-- <input type="email" class="form-control" id="tussenvoegsel" name="TussenVoegsel"/> -->
								echo "<div class=\"col-sm-2\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"tussenvoegsel\" name=\"tussenVoegsel\" value=".utf8_encode($bericht->tussenvoegsel)." >";
								echo "</div>";	
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3 text-left\" for=\"voornaam\">Voornaam *</label>";
								//<!-- <input type="text" class="form-control" id="voornaam" name="VoorNaam" required="required" pattern="[a-zA-Z0-9]{5,}" title="At least 5 letters and numbers"/> -->
								echo "<div class=\"col-sm-9\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"voornaam\" name=\"voorNaam\" value=".utf8_encode($bericht->voornaam)." required=\"required\"  />";
								echo "</div>";
							echo "</div>";
							echo "<div class=\"row\>";
								echo "<label class=\" col-sm-3 text-left\"  for=\"voornaam\">Email *</label>";
								//<!-- <input type="text" class="form-control" id="voornaam" name="VoorNaam" required="required" pattern="[a-zA-Z0-9]{5,}" title="At least 5 letters and numbers"/> -->
								echo "<div class=\"col-sm-9\">";
									echo "<input type=\"email\" class=\"form-control input-sm\" id=\"voornaam\" name=\"email\" value=".utf8_encode($bericht->user_email)." required=\"required\" pattern=\"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$\" />";
								echo "</div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3 col-offset-1\" for=\"straat\">Straat </label>";
								//<!-- <input type="text" class="form-control" id="straat" name="Straat" required="required"/> -->
								echo "<div class=\"col-sm-9\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"straat\" name=\"straat\" value=".utf8_encode($bericht->straat)." />";
								echo "</div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3\" for=\"huisnummer\">Huisnummer</label>";
								//<!-- <input type="text" class="form-control" id="huisnummer" name="HuisNummer" placeholder="Huisnummer"/> -->
								echo "<div class=\"col-sm-2\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"huisnummer\" name=\"huisNummer\" value=".utf8_encode($bericht->huisnummer)." >";
								echo "</div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3\" for=\"toevoeging\">Toevoeging</label>";
								//<!-- <input type="text" class="form-control" id="huisnummer" name="HuisNummer" placeholder="Huisnummer"/> -->
								echo "<div class=\"col-sm-2\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"toevoeging\" name=\"toevoeging\"/ value=".utf8_encode($bericht->toevoeging).">";
								echo "</div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3\" for=\"postcode\">Postcode</label>";
								//<!-- <input type="text" class="form-control" id="postcode" name="PostCode" placeholder="1032CJ"/> -->
								echo "<div class=\"col-sm-3\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"postcode\" name=\"postCode\" value=".utf8_encode($bericht->postcode)." placeholder=\"1032CJ\"/>";
								echo "</div>";	
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3\" for=\"plaats\">Plaats</label>";
								//<!-- <input type="text" class="form-control" id="plaats" name="Plaats" placeholder="Amsterdam"/> -->
								echo "<div class=\"col-sm-9\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"plaats\" name=\"plaats\" value=".utf8_encode($bericht->plaats)." >";
								echo "</div>";	
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<label class=\"col-sm-3\" for=\"geboortedatum\">Geboortedatum</label>";
								//<!-- <input type="text" class="form-control" id="geboortedatum" name="GeboorteDatum" placeholder="dd-mm-jjjj"/> -->
								echo "<div class=\"col-sm-4\">";
									echo "<input type=\"text\" class=\"form-control input-sm\" id=\"geboortedatum\" name=\"geboorteDatum\" value=".utf8_encode($bericht->geboortedatum)." placeholder=\"dd-mm-jjjj\"/>";
								echo "</div>";	
							echo "</div>";
						echo "</section>";
					
		   echo "<section id=\"sociaal_foto\">";
						echo "<div id=\"foto\" class=\"form-group\">";
								echo "<label  for=\"foto\">Profiel Foto</label>";
								//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
								//<!-- <div  class="col-sm-4 text-left"> -->
								echo "<div>";
									//echo "<input class=\"form-control col-sm-4\" type=\"file\" class=\"form-control\" id=\"fototest\" name=\"foto\" placeholder=\"test\"/>";
									echo "".utf8_encode("<img width=\"80\" height=\"80\" style=\"margin: 5px;\" src=\"$imagepath").utf8_encode($bericht->foto).".jpg\" />";
								echo "</div>";
						echo "</div>";
						/*echo "<div id=\"cv\" class=\"form-group\">";
								echo "<label  for=\"cv\">CV uploaden</label>";
								//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
								//<!-- <div  class="col-sm-4 text-left"> -->
								echo "<div>";
									echo "<input class=\"form-control col-sm-4\" type=\"file\" class=\"form-control\" id=\"fototest\" name=\"cv\" />";
									
								echo "</div>";
						echo "</div>";*/ 
                                              
                          $objecten2 = mysqli_query($connection, "SELECT * FROM  user_sociale_media  WHERE  user_id=$user_id ") or die(mysqli_error());
                            if (mysqli_num_rows($objecten2) == 0) 
                              {
                                die("<i>Nog geen users aanwezig !</i>");
                              }
                            while ($bericht2 = mysqli_fetch_object($objecten2)) 
                              { 
                              
                                if($bericht2->sm_id === '2')
                                {
                                    $_SESSION['twitter'] = ".$bericht2->sm_url.";
                                    $twitter = $_SESSION['twitter'];
                                }
                                if($bericht2->sm_id === '3')
                                {
                                    $_SESSION['facebook'] = ".utf8_encode($bericht2->sm_url).";
                                    $facebook = $_SESSION['facebook'];
                                }                                    
		  if($bericht2->sm_id === '1')
                                {
                                    //$_SESSION['linkedin'] = ".utf8_encode(".$row['sm_url'].").";
                                    $_SESSION['linkedin'] = ".$bericht2->sm_url.";
                                    $linkedin = $_SESSION['linkedin'];
                                }
                                echo "<section id=\"sociale_media\">";
					        echo "<div class=\"form-group\">";
						   echo "<label class=\"control-label col-sm-2\" for=\"linkedin\">LinkedIn</label>";
						//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
						      echo "<div class=\"col-sm-10\">";
                                                                echo "<input type=\"text\" class=\"form-control input-sm\" id=\"linkedin\" name=\"linkedIn\" value=$linkedin />"; 
                                                            //if(".utf8_encode($bericht2->sm_id)." === 1)
                                                                //{
                                                                  //echo "<input type=\"text\" class=\"form-control input-sm\" id=\"linkedin\" name=\"linkedIn\" value=".utf8_encode($bericht2->sm_url)." />";                                                          
                                                                 //}
						     echo "</div>";	
						echo "</div>";
                                                echo "<div class=\"form-group\">";
						   echo "<label class=\"control-label col-sm-2\" for=\"twitter\">Twitter</label>";
								//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
							echo "<div class=\"col-sm-10\">";
                                                                 echo "<input type=\"text\" class=\"form-control input-sm\" id=\"twitter\" name=\"twitter\" value=$twitter/>";
                                                            //if(".utf8_encode($bericht2->sm_id)."=== 2)
                                                               // {
								  //echo "<input type=\"text\" class=\"form-control input-sm\" id=\"twitter\" name=\"twitter\" value=".utf8_encode($bericht2->sm_url)."/>";
                                                                //}      
							echo "</div>";	
                                                echo "</div>";
						echo "<div class=\"form-group\">";
								echo "<label class=\"control-label col-sm-2\" for=\"facebook\">Facebook</label>";
								//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
							echo "<div class=\"col-sm-10\">";
                                                                  echo "<input type=\"text\" class=\"form-control input-sm\" id=\"facebook\" name=\"faceBook\" value=$facebook/>";
                                                            //if(".utf8_encode($bericht2->sm_id)."=== 3)
                                                              //  {
							          //echo "<input type=\"text\" class=\"form-control input-sm\" id=\"facebook\" name=\"faceBook\" value=".utf8_encode($bericht2->sm_url)."/>";
                                                              //  }  
						     echo "</div>";	
						echo "</div>";
		                }	
						//echo "</div>";
					 echo "</section>";
                                         
			echo "</section>";	
			       
	echo "</section>";	
									
				echo "<section id=\"functies\">";
						echo "<div class=\"kop\">";
							echo "<p>De functie(s) waarin je geinteresseerd bent en opgegeven werkervaring in die functie(s)op een schaal van 1 t/m 10";
						echo "</div>";
					
					
						echo "<div class=\"row\">";
							echo "<label class=\"col-sm-2 text-left\"><input id=\"functieCheck1\" type=\"checkbox\" value=\"\" name=\"fbox1\" > Java developer</label>";
							
							echo "<div  id=\"ervaringSlider1\" class=\"ervaringSlider col-sm-2\">";
								echo "<input id=\"ervaring1\" data-slider-id=\"ervaringSlider1\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=\"0\" tooltip=\"hide\"/>";		
								echo "<div>";
									echo "<span  id=\"ex1CurrentSliderValLabel\"> <span id=\"ex1SliderVal\">&nbsp 0</span></span>";
								echo "</div>";	
								
							echo "</div>";
							echo "<label class=\"col-sm-2 text-left\"><input id=\"functieCheck2\" type=\"checkbox\" value=\"\" name=\"fbox2\" > Functioneel ontwerper</label>";
							
								echo "<div id=\"ervaringSlider2\" class=\"ervaringSlider col-sm-2\">";
									echo "<input id=\"ervaring2\" data-slider-id=\"ervaringSlider2\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=\"0\" tooltip=\"always\"/>";		
									echo "<div >";
										echo "<span id=\"ex2CurrentSliderValLabel\"> <span id=\"ex2SliderVal\">0</span></span>";
									echo "</div>";
									//<!-- <input type="range" value= "5" min="0" max="10"> -->
								echo "</div>"; 
						echo "</div>";
						/*echo "<div class=\"row\">";
							echo "<label class=\"col-sm-3 text-left\"><input id=\"functieCheck2\" type=\"checkbox\" value=\"\" > Functioneel ontwerper</label>";
							
								echo "<div id=\"ervaringSlider2\" class=\"ervaringSlider col-sm-2\">";
									echo "<input id=\"ervaring2\" data-slider-id=\"ervaringSlider2\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=\"0\" tooltip=\"always\"/>";		
									echo "<div >";
										echo "<span id=\"ex2CurrentSliderValLabel\"> <span id=\"ex2SliderVal\">0</span></span>";
									echo "</div>";
									//<!-- <input type="range" value= "5" min="0" max="10"> -->
								echo "</div>"; 
								
							
						echo "</div>";*/
						echo "<div class=\"row\">";
							echo "<label class=\"divSlider col-sm-3 text-left\"><input id=\"functieCheck3\" type=\"checkbox\" value=\"\" name=\"fbox3\" > .NET developer</label>";
							echo "<div id=\"ervaringSlider3\" class=\"ervaringSlider col-sm-2\">";
								echo "<input id=\"ervaring3\" data-slider-id=\"ervaringSlider3\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=\"0\" tooltip=\"always\"/>";		
								
								echo "<div>";
									echo "<span id=\"ex3CurrentSliderValLabel\"> <span id=\"ex3SliderVal\">0</span></span>";
								echo "</div>";	
								//<!-- <input type="range" value= "5" min="0" max="10"> -->
							echo "</div>";
						echo "</div>";
						echo "<div class=\"row\">";
							echo "<label class=\"col-sm-3 text-left\"><input id=\"functieCheck4\" type=\"checkbox\" value=\"\" name=\"fbox4\" > Test Coordinator</label>";
							echo "<div  id=\"ervaringSlider4\" class=\"ervaringSlider col-sm-2\">";
								echo "<input id=\"ervaring4\" data-slider-id=\"ervaringSlider4\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=\"0\" tooltip=\"always\"/>";
								echo "<div>";
									echo "<span id=\"ex4CurrentSliderValLabel\"> <span id=\"ex4SliderVal\">0</span></span>";
								echo "</div>";	
								//<!-- <input type="range" value= "5" min="0" max="10"> -->
							echo "</div>";
						echo "</div>";
						echo "<div class=\"row\">";
							echo "<label class=\"col-sm-3 text-left\"><input id=\"functieCheck5\" type=\"checkbox\" value=\"\" name=\"fbox5\" > Front-end developer</label>";
							echo "<div id=\"ervaringSlider5\" class=\"ervaringSlider col-sm-2\">";
								echo "<input id=\"ervaring5\" data-slider-id=\"ervaringSlider5\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\" data-slider-value=\"0\" tooltip=\"always\"/>";		
								
								echo "<div>";
									echo "<span id=\"ex5CurrentSliderValLabel\"> <span id=\"ex5SliderVal\">0</span></span>";
									//<!-- <input type="range" value= "5" min="0" max="10"> -->
								echo "</div>";
							echo "</div>";
						echo "</div>";	 
						echo "<div class=\"row\">";
							echo "<label class=\"divSlider col-sm-3 text-left\"><input id=\"functieCheck6\" type=\"checkbox\" value=\"\" name=\"fbox6\" > Back-end developer</label>";
							echo "<div id=\"ervaringSlider6\" class=\"ervaringSlider col-sm-2\">";
								echo "<input  id=\"ervaring6\" data-slider-id=\"ervaringSlider6\" type=\"text\" data-slider-min=\"0\" data-slider-max=\"10\" data-slider-step=\"1\"  tooltip=\"always\"/>";		
							
								echo "<div>";
									echo "<span id=\"ex6CurrentSliderValLabel\"> <span id=\"ex6SliderVal\">0</span></span>";
									//<!-- <input type="range" value= "5" min="0" max="10"> -->
								echo "</div>";
							echo "</div>";
						echo "</div>";	
							
				echo "</section>";
				
				echo "<section id=\"mobielFinUitkering\">";
					
					
					echo "<section id=\"mobielFinancieel\">";
						echo "<div class=\"form-group\">";
                                                      if(null !==($bericht->user_rijbewijs)){
							echo "<label class=\"col-sm-5 text-left\"><input id=\"rijbewijsCheck\" type=\"checkbox\" name=\"rijbewijs\" checked> Rijbewijs</label>";
                                                         }
                                                    
						echo "</div>";
						echo "<div class=\"form-group\" id=\"auto\">";
							echo "<label class=\"col-sm-5 text-left\"><input id=\"autoCheck\" type=\"checkbox\" value=\"\" > Auto</label>";					
						echo "</div>";
						echo "<div class=\"form-group\" id=\"financieel\">";
							echo "<label class=\"col-sm-5\" for=\"salaris\">Salaris indicatie</label>";
							echo "<div class=\"col-sm-5\">";
								echo "<input type=\"text\" class=\"form-control input-sm\" id=\"salaris\" name=\"salaris\" />";	
							echo "</div>";	
						echo "</div>";
						echo "<div class=\"form-group\" id=\"uitkering\">";
							echo "<label class=\"col-sm-5 \" for=\"uitkering\">Soort uitkering</label>";
							echo "<div class=\"col-sm-4\">";
				                        echo "<input type=\"text\" class=\"form-control input-sm\" id=\"salaris\" name=\"salaris\" value=".utf8_encode($bericht->uitkeringsoort)."/>";
							echo "</div>";	
						echo "</div>";
						echo "<div class=\"form-group\" id=\"ww\">";
							echo "<label class=\"col-sm-5\" for=\"salaris\">Uitkering geldig tot</label>";
							echo "<div class=\"col-sm-4\">";
								echo "<input type=\"text\" class=\"form-control input-sm\" id=\"salaris\" name=\"geldigTot\" value=".utf8_encode($bericht->uitkering_geldig_tot)." />";
							echo "</div>";	
						echo "</div>";
					echo "</section>";	
					
					echo "<section id=\"sectorwerk\">";
						
						echo "<div id=\"sector\">";
							echo "<div class=\"kop\">";
								echo "<p>De sector(s) waarin je werkzaam bent geweest</p>";
							echo "</div>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\"  name=\"werbox1\">ICT";
							echo "</label>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\"name=\"werbox2\">Zorg";
							echo "</label>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\"name=\"werbox3\">Industrie";
							echo "</label>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\"name=\"werbox4\">Retail";
							echo "</label>";
						echo "</div>";
						echo "<br><br><br>";
			
						/*echo "<div id=\"bedrijf\">";
							echo "<div class=\"kop\">";
								echo "<p>Gewenste grootte van het bedrijf (in aantal medewerkers)</p>";
							echo "</div>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\">1-10";
							echo "</label>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\">10-50";
							echo "</label>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\">50-100";
							echo "</label>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\">100-500";
							echo "</label>";
							echo "<label class=\"checkbox-inline\">";
								echo "<input type=\"checkbox\" value=\"\">>500";
							echo "</label>";
						echo "</div>";*/
                                                                     
                                                                                           
                                                                                     echo "<div class=\"form-group\" id=\"uitkering\">";
							echo "<label class=\"col-sm-5 \" for=\"uitkering\">Gewenste grootte bedrijf:</label>";
							echo "<div class=\"col-sm-4\">";
								echo "<select class=\"form-control input-sm\" name=\"bedrijfgrootte\">";
									echo "<option value=\"1-10\">1-10</option>
									<option value=\"10-50\">10-50</option>
									<option value=\"50-100\">50-100</option>
									<option value=\">500\">>500</option>";
							 echo "</select>";
							echo "</div>";	
						echo "</div>";
                                                
                                                
                                                                                 
					echo "</section>";
				echo "</section>"; 
				
										
				echo "<section id=\"regio\">";
					echo "<div class=\"kop\">";
						echo "<p>Geef de maximale reisafstand en vink de gewenste regio's aan</p>";
					echo "</div>";	
					echo "<div class=\"form-group\">";
							echo "<label class=\"col-sm-1\" for=\"reisafstand\">Reisafstand</label>";
							//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
							echo "<div class=\"col-sm-2\">";
								echo "<input type=\"text\" class=\"form-control input-sm\" id=\"reisafstand\" name=\"reisafstand\" placeholder=\"in km\" />";
							echo "</div>";

							/*echo "<label class=\"col-sm-1\" for=\"reisduur\">Reisduur</label>";
							//<!-- <input type="text" class="form-control" id="achternaam" name="AchterNaam" required="required"/> -->
							echo "<div class=\"col-sm-2\">";
								echo "<input type=\"text\" class=\"form-control input-sm\" id=\"reisduur\" name=\"reisduur\"  />";*/
							echo "</div>";							
					echo "</div>";	
					
					
					echo "<div class=\"form-group\">";
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"noordholland\" value=\"\" > Noord-Holland";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"limburg\" value=\"\" > Limburg";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"flevoland\" value=\"\" > Flevoland";
							echo "</label>";
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"amsterdam\" value=\"\" > Amsterdam";
							echo "</label>";
					echo "</div>";
					echo "<div class=\"form-group\">";
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"zuidholland\" value=\"\" > Zuid-Holland";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"gelderland\" value=\"\" > Gelderland";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"drenthe\" value=\"\" > Drenthe";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"rotterdam\" value=\"\" > Rotterdam";
							echo "</label>";
					echo "</div>";
					echo "<div class=\"form-group\">";
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"zeeland\" value=\"\" > Zeeland";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"overijssel\" value=\"\" > Overijssel";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"friesland\" value=\"\" > Friesland";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"eindhoven\" value=\"\" > Eindhoven";
							echo "</label>";
					echo "</div>";
					echo "<div class=\"form-group\">";
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"noordbrabant\" value=\"\" > Noord-Brabant";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"utrecht\" value=\"\" > Utrecht";
							echo "</label>";
							
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"groningen\" value=\"\" > Groningen";
							echo "</label>";
														
							echo "<label class=\"col-sm-2 text-left\">";
								echo "<input  type=\"checkbox\" name=\"nijmegen\" value=\"\" > Nijmegen";
							echo "</label>";
					echo "</div>";	
				echo "</section>";
				
				
				echo "<section id=\"opmerkingSection\">";
					echo "<div class=\"kop\">";
						echo "<p>Opmerkingen</p>";
					echo "</div>";	
					echo "<div class=\"col-sm-6\">";
						echo "<textarea class=\"form-control\"  name=\"opmerkingen\" rows=\"5\">	</textarea>";									 
					echo "</div>";	
					echo "<br>";
				echo "</section>";

		echo "</div>";
			
        }
         
         // Einde van de kandidaat gegevens, toegevoegd op zat 16 juli
        
        
        //vrijdag 8 juli 2016 toegevoegd
       /* echo "<h3 class=\"data-overzicht\"> ".$_SESSION["loginnaam"].", dit is een overzicht van je gegevens</h3>";// css in style.css vanaf r433
        echo "<table id=\"edit\" cellpadding=\"3\" cellspacing=\"3\" >";
        echo "<tbody>";
        echo "<tr>";
        echo "<th width=\"50\" align=\"left\">Edit</th>";
        echo "<th width=\"50\" align=\"left\">Pasfoto</th>";
        echo "<th width=\"50\" align=\"left\">Geregistreerd sinds</th>";        
        echo "<th width=\"50\" align=\"left\">Achternaam</th>";
        echo "<th width=\"50\" align=\"left\">Tussenvoegsel</th>";
        echo "<th width=\"50\" align=\"left\">Voornaam</th>";
        echo "<th width=\"50\" align=\"left\">Straat</th>";
        echo "<th width=\"50\" align=\"left\">Huisnummer</th>";
        echo "<th width=\"50\" align=\"left\">Postcode</th>";
        echo "<th width=\"50\" align=\"left\">Plaats</th>";
        echo "<th width=\"50\" align=\"left\">Telefoon</th>";
        echo "<th width=\"50\" align=\"left\">Geb.Datum</th>";
        echo "<th width=\"50\" align=\"left\">Salaris Indicatie</th>";
        echo "<th width=\"50\" align=\"left\">WW-geldig-tot</th>";
        echo "<th width=\"50\" align=\"left\">Sector-afkomstig</th>";
        echo "<th width=\"50\" align=\"left\">Bedrijf-grootte</th>";
        echo "<th width=\"50\" align=\"left\">Rijbewijs</th>";
        echo "<th width=\"50\" align=\"left\">Auto</th>";
        
        
        echo "</tr>";

	while ($bericht = mysqli_fetch_object($objecten)) 
        {
            $imagepath=$GLOBALS['path']."assets/images/";
            echo "<tr>";
            echo "<td width=\"50\" align=\"left\"><a href=\"".$_SERVER['PHP_SELF']."?user_id=".$bericht->user_id."\">edit</a></td>";
            echo "<td>".utf8_encode("<img width=\"60\" height=\"60\" style=\"margin: 5px;\" src=\"$imagepath").utf8_encode($bericht->foto).".jpg\" /></td>";
            echo "<td>".utf8_encode($bericht->user_sinds)."</td>";
            echo "<td>".utf8_encode($bericht->achternaam)."</td>";
            echo "<td>".utf8_encode($bericht->tussenvoegsel)."</td>";
            echo "<td>".utf8_encode($bericht->voornaam)."</td>";
            echo "<td>".utf8_encode($bericht->straat)."</td>";
            echo "<td>".utf8_encode($bericht->huisnummer)."</td>";
            echo "<td>".utf8_encode($bericht->postcode)."</td>";
            echo "<td>".utf8_encode($bericht->plaats)."</td>";
            echo "<td>".utf8_encode($bericht->telefoon)."</td>";
            echo "<td>".utf8_encode($bericht->geboortedatum)."</td>";
            echo "<td>".utf8_encode($bericht->salaris)."</td>";
            echo "<td>".utf8_encode($bericht->uitkering_geldig_tot)."</td>";
            echo "<td>".utf8_encode($bericht->user_sector)."</td>";
            echo "<td>".utf8_encode($bericht->user_bedrijf_grootte)."</td>";
            echo "<td>".utf8_encode($bericht->user_rijbewijs)."</td>";
            echo "<td>".utf8_encode($bericht->user_auto)."</td>";
            
            
            echo "</tr>";
        }

        echo "</table>";
        echo "<table>";
        echo "<tr><td colspan='3'></td>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";    */
        
             
        
}

function userBewerken()
{
    global $connection; 
    
   /* if (!isset($_GET['user_id']))
    {
        redirect($_SERVER['PHP_SELF']);
        die();
    }*/
    
    $user_id = $_SESSION['user_id'];
    //$bericht = mysqli_query("SELECT * FROM user WHERE user_id = ".$_GET['user_id']." LIMIT 1") or die(mysqli_error());
    $bericht = mysqli_query($connection, "SELECT * FROM user WHERE user_id = ".$user_id." LIMIT 1") or die(mysqli_error());
    if (mysqli_num_rows($bericht) == 0)
    {
        die("Deze user bestaat niet !");
    }
    $bericht = mysqli_fetch_object($bericht);
    echo "<section id=\"section-bewerk\">";// de css voor deze tabel is in styles.css vanaf regel 408
    //echo "<h4 class=\"wijzig\">Wijzigen van user:</h4> <a class=\"edit\">".utf8_encode($bericht->user_inlognaam)."</a> met ID: <a class=\"edit\">".($bericht->user_id)."</a><br /><br />";
    echo "<div id=\"bewerk1\"><h4 style=\"text-align:center; color:#ffcc00;\">Hier kunt u uw gegevens wijzigen</h4><hr/></div><br />";
    echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" enctype=\"multipart/form-data\">";
    echo "<table id=\"table-bewerk\" width=\"100%\" cellpadding=\"0\" cellspacing=\"2\">";
    echo "<tr><td class=\"bewerk\" width=\"150\">User inlognaam:</td>";
    //echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->usr_inlognaam)."\" size=\"50\" name=\"usr_inlognaam\" /></td></tr>";
    echo "<td class=\"bewerk\">".utf8_encode($bericht->user_inlognaam)."</td></tr>";
    echo "<tr><td></td>";
    echo "<tr><td class=\"bewerk\" class=\"bewerk\" width=\"150\">Rijbewijs:</td>";
        echo "<td><input type=\"radio\" name=\"user_rijbewijs\"";
    $waarde="nee";
    echo "value=$waarde ".(($bericht->user_rijbewijs==$waarde)?"checked":"")."> $waarde ";
    echo "<input type=\"radio\" name=\"user_rijbewijs\"";
    $waarde="ja";
    echo "value=$waarde ".(($bericht->user_rijbewijs==$waarde)?"checked":"")."> $waarde ";
    echo "</td></tr>";
    echo "<tr><td class=\"bewerk\" width=\"150\">Auto:</td>";
    echo "<td><input type=\"radio\" name=\"user_auto\"";
    $waarde="nee";
    echo "value=$waarde ".(($bericht->user_auto==$waarde)?"checked":"")."> $waarde ";
    echo "<input type=\"radio\" name=\"user_auto\"";
    $waarde="ja";
    echo "value=$waarde ".(($bericht->user_auto==$waarde)?"checked":"")."> $waarde ";
    
    echo "<tr><td class=\"bewerk\" width=\"150\">Straat:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->straat)."\" size=\"50\" name=\"straat\" /></td></tr>";
    echo "<td>".utf8_encode($bericht->straat)."</td></tr>";
    
    echo "<tr><td class=\"bewerk\" width=\"150\">Huisnummer:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->huisnummer)."\" size=\"50\" name=\"huisnummer\" /></td></tr>";
    echo "<td>".utf8_encode($bericht->huisnummer)."</td></tr>";
    
    echo "<tr><td class=\"bewerk\" width=\"150\">Postcode:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->postcode)."\" size=\"50\" name=\"postcode\" /></td></tr>";
    echo "<td>".utf8_encode($bericht->postcode)."</td></tr>";
    
    echo "<tr><td class=\"bewerk\" width=\"150\">Plaats:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->plaats)."\" size=\"50\" name=\"plaats\" /></td></tr>";
    echo "<td>".utf8_encode($bericht->plaats)."</td></tr>";
    
     echo "<tr><td class=\"bewerk\" width=\"150\">Telefoon:</td>";
    echo "<td><input type=\"text\" value=\"".utf8_encode($bericht->telefoon)."\" size=\"50\" name=\"telefoon\" /></td></tr>";
    echo "<td>".utf8_encode($bericht->telefoon)."</td></tr>";
            
    echo "<tr><td>&nbsp;</td>";
    echo "<td><input type=\"hidden\" name=\"user_id\" value=\"".$bericht->user_id."\" />";
    echo "<input type=\"submit\" name=\"submit_edit_item\" value=\" Opslaan !\" /></td></tr>";
    echo "</table>";
    echo "</form>";
    echo "</section>";
}

function userBewerktOpslaan()
{   
    global $connection; 
    
    $zoek = array("'", "á", "é", "í", "ó", "ú", "ñ", "ç", "Á", "É", "Í", "Ó", "Ú", "Ñ", "Ç", "à", "è", "ì", "ò", "ù", "À", "È", "Ì", "Ò", "Ù",
     "ä", "ë", "ï", "ö", "ü", "Ä", "Ë", "Ï", "Ö", "Ü", "â", "ê", "î", "ô", "û", "Â", "Ê", "Î", "Ô", "Û", "ā", "ū", "ś", "ī");

    $maakentity = array("&acute;", "&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;", "&ccedil;", "&Aacute;",
    "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;", "&Ccedil;", "&agrave;", "&egrave;", "&igrave;", "&ograve;",
     "&ugrave;", "&Agrave;", "&Egrave;", "&Igrave;", "&Ograve;", "&Ugrave;", "&auml;", "&euml;", "&iuml;", "&ouml;",
    "&uuml;", "&Auml;", "&Euml;", "&Iuml;", "&Ouml;", "&Uuml;", "&acirc;", "&ecirc;", "&icirc;", "&ocirc;", "&ucirc;", "&Acirc;",
    "&Ecirc;", "&Icirc;", "&Ocirc;", "&Ucirc;", "&#257;", "&#363;", "&#347;", "&#299;");
    
    $user_rijbewijs=(trim($_POST['user_rijbewijs']));
    $user_rijbewijs=str_replace($zoek, $maakentity, $user_rijbewijs);
    $user_auto=(trim($_POST['user_auto']));          
    $user_auto = str_replace($zoek, $maakentity, $user_auto);
    $straat = (trim($_POST['straat'])); 
    $straat = str_replace($zoek, $maakentity, $straat);
    $huisnummer = (trim($_POST['huisnummer'])); 
    $huisnummer = str_replace($zoek, $maakentity, $huisnummer);
    $postcode = (trim($_POST['postcode'])); 
    $postcode = str_replace($zoek, $maakentity, $postcode);
    $plaats = (trim($_POST['plaats'])); 
    $plaats = str_replace($zoek, $maakentity, $plaats);
    $telefoon = (trim($_POST['telefoon'])); 
    $telefoon = str_replace($zoek, $maakentity, $telefoon);

    if (isset($_POST['submit_edit_item']))
    {
        mysqli_query($connection, "UPDATE `user` SET `user_id` ='".$_POST['user_id']."', `user_rijbewijs` ='".$user_rijbewijs."', `user_auto`= '".$user_auto."',  `straat`= '".$straat."' "
                . " ,`huisnummer` = '".$huisnummer."', `postcode`= '".$postcode."', `plaats`= '".$plaats."',"
                . "`telefoon`= '".$telefoon."'  WHERE `user_id` = ".$_POST['user_id']." ") or die(mysqli_error());
    }
    $result_id=$_POST['user_id'];
    show_tekst($result_id);
    echo "</div>";
}

function show_tekst($result_id)
{
    global $connection; 
    
    $result_sql = mysqli_query($connection, "SELECT * FROM user WHERE user_id=".$result_id."");
    while($q=mysqli_fetch_array($result_sql))
    {
        echo "De tekst is gewijzigd en ziet er als onderstaand uit.<br />";
        echo "<a href=\"".$_SERVER['PHP_SELF']."?user_id=".$q['user_id']."\" >Klik hier als u nog iets in de tekst wilt veranderen.</a><br /><br />";
        echo "<table cellpadding=\"2\">"; // width=\"90%\">";
        echo "<tr><th>User inlognaam:&nbsp;</th><td class=\"kleur\">".$q['user_inlognaam']."</td></tr>";
        //echo "<tr><th>User wachtwoord:&nbsp;</th><td class=\"kleur\">".$q['user_wachtwoord']."</td></tr>";
        echo "<tr><th>Rijbewijs:&nbsp;</th><td class=\"kleur\">".$q['user_rijbewijs']."</td></tr>";
        echo "<tr><th>Auto bezit:&nbsp;</th><td class=\"kleur\">".$q['user_auto']."</td></tr>";
        echo "<tr><th>Straat:&nbsp;</th><td class=\"kluer\">".$q['straat']."</td></tr>";
        echo "<tr><th>Huisnummer:&nbsp;</th><td class=\"kluer\">".$q['huisnummer']."</td></tr>";
        echo "<tr><th>Postcode:&nbsp;</th><td class=\"kluer\">".$q['postcode']."</td></tr>";
        echo "<tr><th>Plaats:&nbsp;</th><td class=\"kluer\">".$q['plaats']."</td></tr>";
        echo "<tr><th>Telefoon:&nbsp;</th><td class=\"kluer\">".$q['telefoon']."</td></tr>";
        echo "</table><p><hr/ height=\"3px\"></p>";
        overzicht();
    }
}

?>