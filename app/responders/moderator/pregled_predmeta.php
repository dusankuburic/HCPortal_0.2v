<?php
require_once("../../models/Predmet.php");
header("Content-Type: application/json; charset=UTF-8");


$predmet = new Predmet();
$svi_predmeti = $predmet->svi_predmeti();
echo json_encode($svi_predmeti);
    

?>