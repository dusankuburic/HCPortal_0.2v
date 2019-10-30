<?php
require_once("../../models/Moderator.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['moderat'])){

    $moderator = new Moderator();
    $moderator_sa_sifrom = $moderator->sa_sifrom($_POST['moderat']);

    if($moderator_sa_sifrom){
        echo json_encode($moderator_sa_sifrom);
    }
}

?>