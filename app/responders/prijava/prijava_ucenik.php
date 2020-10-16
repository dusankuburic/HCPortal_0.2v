<?php
session_start();
require_once("../../models/Database.php");
require_once("../../repositories/UcenikRepository.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['user'])){
 
    $ucenik = new UcenikRepository(new Database());
    $result = $ucenik->prijava($_POST['user']);
    if($result['stanje_prijave'] == true){

        session_unset();
        $_SESSION['ucenik'] = $result['korisnicko_ime'];
        echo "../layouts/ucenik.php?route=pocetna";
    }  else {
        echo "greska";
    }  
}

?>