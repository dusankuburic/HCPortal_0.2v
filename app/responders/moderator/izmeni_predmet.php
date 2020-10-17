<?php
require_once("../../models/Database.php");
require_once("../../repositories/PredmetRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['predmet'])){
    
    $predmetRepository = new PredmetRepository(new Database());
    $rezultat = $predmetRepository->izmeni_predmet($_POST['predmet']);

    echo $rezultat;
} 
?>