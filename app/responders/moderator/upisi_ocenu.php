<?php
require_once("../../models/Database.php");
require_once("../../repositories/ProfesorRepository.php");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST['za_upis'])){
    
    $profesorRepository = new ProfesorRepository(new Database());
    $rezultat = $profesorRepository->upisi_ocenu($_POST['za_upis']);

    echo $rezultat; 
} 
?>