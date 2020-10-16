<?php
require_once("../../repositories/UcenikRepository.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['ucen'])){
    
    $ucenikRepository = new UcenikRepository();
    $rezultat = $ucenikRepository->izmeni_ucenika($_POST['ucen']);

    echo $rezultat; 
} 


?>