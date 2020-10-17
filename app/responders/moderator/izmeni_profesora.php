<?php
require_once("../../models/Database.php");
require_once("../../repositories/ProfesorRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['profa'])){
    
    $profesorRepository = new ProfesorRepository(new Database());
    $rezultat = $profesorRepository->izmeni_profesora($_POST['profa']);

    echo $rezultat; 
} 
?>