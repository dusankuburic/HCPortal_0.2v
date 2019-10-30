<?php
require_once("../../models/Moderator.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['moderat'])){
    
    $moderator = new Moderator();
    $rezultat = $moderator->izmeni_moderatora($_POST['moderat']);


    echo $rezultat;
    
} 


?>