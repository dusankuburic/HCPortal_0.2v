<?php
require_once("../../models/Database.php");
require_once("../../repositories/OdeljenjeRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['razred'])){

    $odeljenjeRepository = new OdeljenjeRepository(new Database());
    $sva_odeljenja_sa_razredom = $odeljenjeRepository->sva_odeljenja_sa_razredom($_POST['razred']);
    echo json_encode($sva_odeljenja_sa_razredom);
}
?>