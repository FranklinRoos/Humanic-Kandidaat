<?php
session_start(); //dit script(cv-upload.php) wordt in de applicatie niet (meer) gebruikt(de functies waarin naar verwezen wordt bestaan ook niet(meer) 
include("../../config/config.php");  //ik had dit script voor Thijs toegevoegd tesamen met de navigatie knop 'Cv-Upload' om te laten zien hoe je een nieuwe pagina en knop toevoegt
include("../../config/connect.php"); // in de navigatie tabel(nav_naam= CV=Upload) in de database is dit script in de url opgenomen, de nav_show staat op 'n'
include("../../config/default_functions.php");
include("include/humanic-functions.php");
include("include/formValidatie.php");
//
if(!isSet($_SESSION['loginnaam'])) {
                    echo "<script type=\"text/javascript\">
                                    window.location = \"".$GLOBALS['path']."/application/modules/admin/indexAdmin.php\"
                                     </script>";
}

 $pageNavId=5;
 fHeader($pageNavId);//actief=$pageNavId);
 navigatie($pageNavId);

if(isset($_POST["cv-submit"])) {
    
    //handleCvUploadForm(); // deze functie maak je in humanic-functions.php
    //verwerkCV ();
    //$target_dir = "C:/xampp/htdocs/humanic/assets/user-cv/";
    // $target_file = $target_dir .basename($_FILES["cv"]["name"]);
    cvAfhandeling ();// de functie was in humanic-functions.php, maar bestaat niet meer 
    
}
else {
        
    showCvUploadForm ($cv=""); // de functie was in humanic-functions.php, maar bestaat niet meer
}

