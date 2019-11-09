<?php
require_once("../../models/Ucenik.php");
header("Content-Type: application/json; charset=UTF-8");


$ucenik = new Ucenik();
$svi_ucenici = $ucenik->svi_ucenici();
echo json_encode($svi_ucenici);
    
exit;
?>