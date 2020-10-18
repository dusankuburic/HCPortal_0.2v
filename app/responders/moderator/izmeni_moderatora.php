<?php
require_once("../../models/Database.php");
require_once("../../repositories/ModeratorRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['moderat'])){
    
    $moderatorRepository = new ModeratorRepository(new Database());
    $rezultat = $moderatorRepository->izmeni_moderatora($_POST['moderat']);

    echo $rezultat;
} 
?>