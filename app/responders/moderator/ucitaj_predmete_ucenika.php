<?php
session_start();
require_once("../../models/Ucenik.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['ucen'])){

    $ucenik = new Ucenik();
    $ucenik_sa_sifrom = $ucenik->sa_sifrom($_POST['ucen']);

    if(!$ucenik_sa_sifrom){
        echo "../layouts/moderator.php?route=pocetna";
    } else {
    
    
    $_SESSION['sifra_ucenika'] = $ucenik_sa_sifrom['sifra_ucenika'];
    
    echo "../layouts/moderator.php?route=pregled_predmeta_ucenika&sifra=".$ucenik_sa_sifrom['sifra_ucenika'];
    }
}

?>