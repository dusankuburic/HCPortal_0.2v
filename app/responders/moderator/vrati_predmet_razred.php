<?php
require_once("../../models/Database.php");
require_once("../../repositories/PredmetRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['predmet'])){
    
    $predmetRepository = new PredmetRepository(new Database());
    $predmet_sa_sifrom = $predmetRepository->sa_sifrom_razredima($_POST['predmet']);

    if($predmet_sa_sifrom){
        echo json_encode($predmet_sa_sifrom);
    } 
}

?>