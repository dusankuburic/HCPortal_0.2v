<?php
session_start();
require_once("../../models/Database.php");
require_once("../../repositories/ModeratorRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['user'])){
 
    $moderatorRepository = new ModeratorRepository(new Database());
    $result = $moderatorRepository->prijava($_POST['user']);
    if($result['stanje_prijave'] == true){

        session_unset();
        $_SESSION['moderator'] = $result['korisnicko_ime'];
        echo "../layouts/moderator.php?route=pocetna";
    }  else {
        echo "greska";
    }
}
?>