<?php
require_once("../../models/Database.php");
require_once("../../repositories/OdeljenjeRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['odeljenje'])){
  
    $odeljenjeRepository = new OdeljenjeRepository(new Database());
    $odeljenje_sa_sifrom = $odeljenjeRepository->sa_sifrom($_POST['odeljenje']);

    if($odeljenje_sa_sifrom){
        echo json_encode($odeljenje_sa_sifrom);
    } 
}
?>