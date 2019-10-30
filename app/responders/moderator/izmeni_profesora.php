<?php
require_once("../../models/Profesor.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['profa'])){
    
    $profesor = new Profesor();
    $rezultat = $profesor->izmeni_profesora($_POST['profa']);

    echo $rezultat; 
} 


?>