<?php
require_once("../../models/Predmet.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['predmet'])){

    $predmet = new Predmet();
    $rezultat = $predmet->dodaj_predmet($_POST['predmet']);

    echo $rezultat;
    
}


?>