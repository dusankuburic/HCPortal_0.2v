<?php
session_start();
require_once("../models/Ucenik.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['user'])){
 
    $ucenik = new Ucenik();
    $ucenik->pripremi_parametre_za_prijavu($_POST['user']);
    if($ucenik->prijava() == true){

        session_unset();
        $_SESSION['ucenik'] = $ucenik->korisnicko_ime;
        echo "../layouts/ucenik.php?route=pocetna";
    }  else {

        echo "greska";
    }
     
}


?>