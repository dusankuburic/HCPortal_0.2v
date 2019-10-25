<?php
require_once("../../models/Moderator.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['moderator'])){

    $moderator = new Moderator();
    $rezultat = $moderator->dodaj_moderatora($_POST['moderator']);

    echo $rezultat;

    if($rezultat){
        echo "greska";
    } else {
       echo "radi";
    }
    
}


?>