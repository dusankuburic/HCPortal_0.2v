<?php
require_once("../../models/Database.php");
require_once("../../repositories/UcenikRepository.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['odeljenje'])){
    
    $ucenik = new UcenikRepository(new Database());
    $rezultat = $ucenik->sa_sifrom_odeljenja($_POST['odeljenje']);

    echo json_encode($rezultat); 
    exit;
} 


?>