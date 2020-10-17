<?php
require_once("../../models/Database.php");
require_once("../../repositories/PredmetRepository.php");
header("Content-Type: application/json; charset=UTF-8");

$predmetRepository = new PredmetRepository(new Database());
$svi_predmeti = $predmetRepository->svi_predmeti();
echo json_encode($svi_predmeti);
?>