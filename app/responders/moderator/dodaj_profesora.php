<?php
require_once("../../models/Database.php");
require_once("../../repositories/ProfesorRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['prof'])){

    $profesorRepository = new ProfesorRepository(new Database());                   
    $rezultat = $profesorRepository->dodaj_profesora($_POST['prof']);

    if($rezultat){
        echo "greska";
    } else {
       echo "radi";
    }
}
?>