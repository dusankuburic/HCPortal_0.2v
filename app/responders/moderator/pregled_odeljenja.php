<?php
require_once("../../models/Odeljenje.php");
header("Content-Type: application/json; charset=UTF-8");


$odeljenje = new Odeljenje();
$sva_odeljenja = $odeljenje->sva_odeljenja();
echo json_encode($sva_odeljenja);
exit;  

?>