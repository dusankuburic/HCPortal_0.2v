<?php
ob_start();
require_once("../../models/Odeljenje.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['odeljenje'])){
    
    $odeljenje = new Odeljenje();
    $rezultat = $odeljenje->dodaj_odeljenje($_POST['odeljenje']);


    echo $rezultat;
    
} 


?>