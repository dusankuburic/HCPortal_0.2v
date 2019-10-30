<?php
session_start();
require_once("../../models/Profesor.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['profa'])){

    $profesor = new Profesor();
    $profesor_sa_sifrom = $profesor->sa_sifrom($_POST['profa']);

    if(!$profesor_sa_sifrom){
        echo "../layouts/moderator.php?route=pocetna";
    } else {
    
    
    $_SESSION['sifra_profesora'] = $profesor_sa_sifrom['sifra_profesora'];
    
    echo "../layouts/moderator.php?route=izmeni_profesora&sifra=".$profesor_sa_sifrom['sifra_profesora'];
    }
}

?>