<?php
session_start();
require_once("../../models/Database.php");
require_once("../../repositories/OdeljenjeRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['odeljenje'])){

    $odeljenjeRepository = new OdeljenjeRepository(new Database());
    $odeljenje_sa_sifrom = $odeljenjeRepository->sa_sifrom($_POST['odeljenje']);

    if(!$odeljenje_sa_sifrom){
        echo "../layouts/moderator.php?route=pocetna";
    } else {
        $_SESSION['sifra_odeljenja'] = $odeljenje_sa_sifrom['sifra_odeljenja'];
        echo "../layouts/moderator.php?route=pregled_ucenika_za_upis_ocena&sifra=".$odeljenje_sa_sifrom['sifra_odeljenja'];
    }
}
?>