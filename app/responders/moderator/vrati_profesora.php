<?php
require_once("../../models/Profesor.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['profa'])){

    $profesor = new Profesor();
    $profesor_sa_sifrom = $profesor->sa_sifrom($_POST['profa']);

    if($profesor_sa_sifrom){
        echo json_encode($profesor_sa_sifrom);
    }
    exit;
}

?>