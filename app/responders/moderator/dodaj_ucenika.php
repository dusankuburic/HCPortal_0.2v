<?php
require_once("../../repositories/UcenikRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['ucen'])){

    $ucenikRepository = new UcenikRepository();                   
    $rezultat = $ucenikRepository->dodaj_ucenika($_POST['ucen']);

    if($rezultat){
        echo "greska";
    } else {
       echo "radi";
    }
}


?>