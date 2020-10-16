<?php
require_once("../../models/Database.php");
require_once("../../repositories/UcenikRepository.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['polugodiste'])){
    
    $ucenikRepository = new UcenikRepository(new Database());
    $rezultat = $ucenikRepository->ocene_sa_polugodista($_POST['polugodiste']);

    echo json_encode($rezultat); 
    exit;
} 


?>