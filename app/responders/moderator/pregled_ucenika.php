<?php
require_once("../../repositories/UcenikRepository.php");
header("Content-Type: application/json; charset=UTF-8");

$ucenik = new UcenikRepository();
$svi_ucenici = $ucenik->svi_ucenici();

echo json_encode($svi_ucenici);

?>