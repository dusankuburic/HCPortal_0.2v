<?php
require_once("../../models/Database.php");
require_once("../../repositories/UcenikRepository.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['ucen'])){

    $ucenikRepositroy = new UcenikRepository(new Database());
    $ucenik_sa_sifrom = $ucenikRepositroy->sa_sifrom($_POST['ucen']);

    if($ucenik_sa_sifrom){
        echo json_encode($ucenik_sa_sifrom);
    }
}

?>