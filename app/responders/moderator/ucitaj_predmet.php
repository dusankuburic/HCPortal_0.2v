<?php
session_start();
require_once("../../models/Predmet.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['predmet'])){

    
$predmet= new Predmet();
$predmet_sa_sifrom = $predmet->sa_sifrom($_POST['predmet']);

if(!$predmet_sa_sifrom){
    echo "../layouts/moderator.php?route=pocetna";
} else {


$_SESSION['sifra_predmeta'] = $predmet_sa_sifrom['sifra_predmeta'];

echo "../layouts/moderator.php?route=izmeni_predmet&sifra=".$predmet_sa_sifrom['sifra_predmeta'];
//echo json_encode($odeljenje_sa_sifrom);

}

}
    

?>