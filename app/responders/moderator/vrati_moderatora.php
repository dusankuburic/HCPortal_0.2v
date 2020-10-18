<?php
require_once("../../models/Database.php");
require_once("../../repositories/ModeratorRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['moderat'])){

    $moderatorRepository = new ModeratorRepository(new Database());
    $moderator_sa_sifrom = $moderatorRepository->sa_sifrom($_POST['moderat']);

    if($moderator_sa_sifrom){
        echo json_encode($moderator_sa_sifrom);
    }
}
?>