<?php
require_once("../../models/Database.php");
require_once("../../repositories/UcenikRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['ucen'])){

    $ucenikRepository = new UcenikRepository(new Database());                   
    $rezultat = $ucenikRepository->dodaj_ucenika($_POST['ucen']);

    if($rezultat){
        echo "greska";
    } else {
       echo "radi";
    }
}


?>