<?php
require_once("../../models/Database.php");
require_once("../../repositories/ProfesorRepository.php");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");

if(isset($_POST['predmeti_profesora'])){
    
    $profesorRepository = new ProfesorRepository(new Database());
    $rezultat = $profesorRepository->dodeli_predmete($_POST['predmeti_profesora']);

    echo $rezultat;
} 
?>