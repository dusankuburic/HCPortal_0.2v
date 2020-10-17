<?php
require_once("../../models/Database.php");
require_once("../../repositories/ProfesorRepository.php");
header("Content-Type: application/json; charset=UTF-8");

$profesor = new ProfesorRepository(new Database());
$svi_profesori = $profesor->svi_profesori();
echo json_encode($svi_profesori);
?>