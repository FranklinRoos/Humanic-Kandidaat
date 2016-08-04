<?php
session_start();
include("../../config/config.php");
include("../../config/connect.php");
include("../../config/default_functions.php");
include("include/humanic-functions.php");
include("include/formValidatie.php");

    global $connection;
    $uploadOk = 1;
    
    $target_dir = "C:/xampp/htdocs/humanic/assets/user-cv/";
    $img_id = uniqid();

    $target_file = $target_dir .basename($_FILES["cv"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    
    //$cvFileType = pathinfo($_SESSION['cv'], PATHINFO_EXTENSION);
    $extensionPos = strripos($_SESSION['cv'], ".");
    
    
    $strLen = strlen($_SESSION['cv']);
    $cvFileType = substr($_SESSION['cv'], $extensionPos + 1, $strLen);
    
    // Check if file already exists
    if ($_SESSION['cv'] != "") {
        //controle file type, niet gelijk dan file type vervangen
        if ($imageFileType != $cvFileType){
            $_FILES["cv"]["name"] = substr_replace($_SESSION['cv'],$imageFileType, $extensionPos + 1);
            $_SESSION['cv'] = $_FILES["cv"]["name"] ;
        }
        else {
            $_FILES["cv"]["name"] = $_SESSION['cv'];
        }
        $target_file = $target_dir .basename($_FILES["cv"]["name"]);
    }
    else {
        $_FILES["cv"]["name"] = $img_id . "." . $imageFileType;
        $target_file = $target_dir .basename($_FILES["cv"]["name"]);
    }   


// Check file size
    if ($_FILES["cv"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats

    if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "txt" && $imageFileType != "pdf") {
        echo "Sorry, only DOC, DOCX, PDF and TXT files are allowed.";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file)) {

            $_SESSION['cv'] = basename($_FILES["cv"]["name"]);
            $sql = mysqli_query($connection, "UPDATE `user` SET `user_cv` = '".$_SESSION['cv']."'
                                                WHERE `user_id` = '".$_SESSION['user_id']."'");
            if (mysqli_affected_rows($connection) == -1){
              echo mysqli_error($connection);
            }
            echo "uw CV is opgeslagen, u kunt het venster sluiten";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } 
    
    //showKandidaatRegForm();
    
 
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
