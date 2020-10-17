<?php
session_start();
require_once("../../models/Database.php");
require_once("../../repositories/ProfesorRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['profa'])){

    $profesorRepository = new ProfesorRepository(new Database());
    $profesor_sa_sifrom = $profesorRepository->sa_sifrom($_POST['profa']);

    if(!$profesor_sa_sifrom){
        echo "../layouts/moderator.php?route=pocetna";
    } else { 
        $_SESSION['sifra_profesora'] = $profesor_sa_sifrom['sifra_profesora'];     
        echo "../layouts/moderator.php?route=izmeni_profesora&sifra=".$profesor_sa_sifrom['sifra_profesora'];
    }
}
?>