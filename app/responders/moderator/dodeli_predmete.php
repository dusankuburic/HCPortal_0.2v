<?php
require_once("../../models/Profesor.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['predmeti_profesora'])){
    
    $profesor = new Profesor();
    $rezultat = $profesor->dodeli_predmete($_POST['predmeti_profesora']);

    echo $rezultat;
} 


?>