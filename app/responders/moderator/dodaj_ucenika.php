<?php
require_once("../../models/Ucenik.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['ucen'])){


    $ucenik = new Ucenik();                   
    $rezultat = $ucenik->dodaj_ucenika($_POST['ucen']);

    if($rezultat){
        echo "greska";
    } else {
       echo "radi";
    }
    
    exit;
}


?>