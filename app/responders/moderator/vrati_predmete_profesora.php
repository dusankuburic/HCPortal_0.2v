<?php
require_once("../../models/Database.php");
require_once("../../repositories/ProfesorRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['profa'])){
 
    $profesor = new ProfesorRepository(new Database());
    $predmete_koje_predaje = $profesor->predmeti_koje_predaje_odeljenjima($_POST['profa']);

    if($predmete_koje_predaje){
        echo json_encode($predmete_koje_predaje);
    } 
}
?>