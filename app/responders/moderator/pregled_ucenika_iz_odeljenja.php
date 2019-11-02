<?php
require_once("../../models/Ucenik.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['odeljenje'])){
    
    $ucenik = new Ucenik();
    $rezultat = $ucenik->sa_sifrom_odeljenja($_POST['odeljenje']);

    echo json_encode($rezultat); 
} 


?>