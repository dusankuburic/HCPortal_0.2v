<?php
require_once("../../repositories/UcenikRepository.php");
header("Content-Type: application/json; charset=UTF-8");

$ucenikRepositroy = new UcenikRepository();
$svi_ucenici = $ucenikRepositroy->svi_ucenici();

echo json_encode($svi_ucenici);

?>