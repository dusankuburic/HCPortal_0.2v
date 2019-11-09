<?php
require_once("../../models/Ucenik.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['ucen'])){
    
    $ucenik = new Ucenik();
    $rezultat = $ucenik->izmeni_ucenika($_POST['ucen']);

    echo $rezultat; 
    exit;
} 


?>