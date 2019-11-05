<?php
require_once("../../models/Ucenik.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['polugodiste'])){
    
    $ucenik = new Ucenik();
    $rezultat = $ucenik->ocene_sa_polugodista($_POST['polugodiste']);

    echo json_encode($rezultat); 
} 


?>