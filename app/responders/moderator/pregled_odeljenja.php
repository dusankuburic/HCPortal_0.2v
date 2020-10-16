<?php
require_once("../../models/Database.php");
require_once("../../repositories/OdeljenjeRepository.php");
header("Content-Type: application/json; charset=UTF-8");

$odeljenjeRepository = new OdeljenjeRepository(new Database());
$sva_odeljenja = $odeljenjeRepository->sva_odeljenja();
echo json_encode($sva_odeljenja);
?>