<?php
session_start();
require_once("../models/Moderator.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['user'])){
 
    $moderator = new Moderator();
    $moderator->pripremi_parametre_za_prijavu($_POST['user']);
    if($moderator->prijava() == true){

        session_unset();
        $_SESSION['moderator'] = $moderator->korisnicko_ime;
        echo "../layouts/moderator.php?route=pocetna";
    }  else {

        echo "greska";
    }
     
  
}


?>