<?php
require_once("../../models/Database.php");
require_once("../../repositories/OdeljenjeRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['odeljenje'])){
    
    $odeljenjeRepository = new OdeljenjeRepository(new Database());
    $rezultat = $odeljenjeRepository->izmeni_odeljenje($_POST['odeljenje']);

    echo $rezultat;
} 
?>