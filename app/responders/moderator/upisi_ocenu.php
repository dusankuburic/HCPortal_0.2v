<?php
require_once("../../models/Profesor.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['za_upis'])){
    
    $profesor = new Profesor();
    $rezultat = $profesor->upisi_ocenu($_POST['za_upis']);

    echo $rezultat; 
    exit;
} 


?>