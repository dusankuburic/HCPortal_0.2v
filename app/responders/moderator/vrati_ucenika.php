<?php
require_once("../../models/Ucenik.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['ucen'])){

    $ucenik = new Ucenik();
    $ucenik_sa_sifrom = $ucenik->sa_sifrom($_POST['ucen']);

    if($ucenik_sa_sifrom){
        echo json_encode($ucenik_sa_sifrom);
    }
    exit;
}

?>