<?php
session_start();
require_once("../../repositories/UcenikRepository.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['ucen'])){

    $ucenikRepository = new UcenikRepository();
    $ucenik_sa_sifrom = $ucenikRepository->sa_sifrom($_POST['ucen']);

  

    if(!$ucenik_sa_sifrom){
        echo "../layouts/moderator.php?route=pocetna";
    } else {
    
    
    $_SESSION['sifra_ucenika'] = $ucenik_sa_sifrom->sifra_ucenika;
    
    echo "../layouts/moderator.php?route=pregled_predmeta_ucenika&sifra="."$ucenik_sa_sifrom->sifra_ucenika";
    }

}

?>