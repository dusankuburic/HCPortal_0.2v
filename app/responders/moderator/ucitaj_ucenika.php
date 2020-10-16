<?php
session_start();
require_once("../../models/Database.php");
require_once("../../repositories/UcenikRepository.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['ucen'])){

    $ucenikRepository = new UcenikRepository(new Database());
    $ucenik_sa_sifrom = $ucenikRepository->sa_sifrom($_POST['ucen']);

    if(!$ucenik_sa_sifrom){
        echo "../layouts/moderator.php?route=pocetna";
    } else {
        $_SESSION['sifra_ucenika'] = $ucenik_sa_sifrom->sifra_ucenika;
        echo "../layouts/moderator.php?route=izmeni_ucenika&sifra=".$ucenik_sa_sifrom->sifra_ucenika;
    }
}

?>