<?php
require_once("../../models/Database.php");
require_once("../../repositories/ModeratorRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['moder'])){

    $moderatorRepository = new ModeratorRepository(new Database());                   
    $rezultat = $moderatorRepository->dodaj_moderatora($_POST['moder']);
   
    if($rezultat){
        echo "greska";
    } else {
       echo "radi";
    }
}
?>