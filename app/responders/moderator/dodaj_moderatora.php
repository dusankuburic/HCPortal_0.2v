<?php
require_once("../../models/Moderator.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['moder'])){

    $moderator = new Moderator();                   
    $rezultat = $moderator->dodaj_moderatora($_POST['moder']);
   
    if($rezultat){
        echo "greska";
    } else {
       echo "radi";
    }
    
}

?>