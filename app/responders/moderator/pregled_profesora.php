<?php
require_once("../../models/Profesor.php");
header("Content-Type: application/json; charset=UTF-8");


$profesor = new Profesor();
$svi_profesori = $profesor->svi_profesori();
echo json_encode($svi_profesori);
exit;

?>