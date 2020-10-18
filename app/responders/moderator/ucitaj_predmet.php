<?php
session_start();
require_once("../../models/Database.php");
require_once("../../repositories/PredmetRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['predmet'])){

    $predmetRepository = new PredmetRepository(new Database());
    $predmet_sa_sifrom = $predmetRepository->sa_sifrom($_POST['predmet']);

    if(!$predmet_sa_sifrom){
        echo "../layouts/moderator.php?route=pocetna";
    } else {
        $_SESSION['sifra_predmeta'] = $predmet_sa_sifrom['sifra_predmeta'];
        echo "../layouts/moderator.php?route=izmeni_predmet&sifra=".$predmet_sa_sifrom['sifra_predmeta'];
    }
}
?>