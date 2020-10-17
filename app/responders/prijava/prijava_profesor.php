<?php
session_start();
require_once("../../models/Database.php");
require_once("../../repositories/ProfesorRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['user'])){
 
    $profesor = new ProfesorRepository(new Database());
    $result = $profesor->prijava($_POST['user']);
    if($result['stanje_prijave'] == true){

        session_unset();
        $_SESSION['profesor'] = $result['korisnicko_ime'];
        echo "../layouts/profesor.php?route=pocetna";
    }  else {
       echo "greska";
    }
}
?>