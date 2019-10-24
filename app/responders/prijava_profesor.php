<?php
session_start();
require_once("../models/Profesor.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['user'])){
 
    $profesor = new Profesor();
    $profesor->pripremi_parametre_za_prijavu($_POST['user']);
    if($profesor->prijava() == true){

        session_unset();
        $_SESSION['profesor'] = $profesor->korisnicko_ime;
        echo "../layouts/profesor.php?route=pocetna";
    }  else {

       echo "greska";
    }
     
  
}

?>