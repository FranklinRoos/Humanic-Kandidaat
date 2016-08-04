<?php
session_start();
include("../FPDI/fpdi.php");
include("../fpdf/fpdf.php");
include("../pdf/pdfFunction.php");

include("../../config/config.php");
include("../../config/connect.php");
include("../../config/default_functions.php");
include("include/psinfofunctions.php");

$pageNavId=9;
fHeader($pageNavId);//actief=$pageNavId);
if(isSet($_SESSION["user_authorisatie"])&& $_SESSION["user_authorisatie"]=="admin")
         {
           navigatieA($pageNavId);
         }
 else
     {
       navigatie($pageNavId);      
     }
 
$pdf = new FPDI();

$pageCount = $pdf->setSourceFile("../../../assets/maps/PUBLICATIONLIST.doc");
$tplIdx = $pdf->importPage(1, '/MediaBox');

$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 90);

$pdf->Output();
