<?php
require_once("../../models/Database.php");
require_once("../../repositories/UcenikRepository.php");
header("Content-Type: application/json; charset=UTF-8");




if(isset($_POST['ucen'])){

    $ucenikRepository = new UcenikRepository(new Database());
    $predmeti_koje_uci = $ucenikRepository->predmeti_koje_uci($_POST['ucen']);
    echo json_encode($predmeti_koje_uci);
    exit;
}
    

?>