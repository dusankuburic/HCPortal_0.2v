<?php
require_once("../../models/Profesor.php");
header("Content-Type: application/json; charset=UTF-8");



if(isset($_POST['prof'])){


    $profesor = new Profesor();                   
    $rezultat = $profesor->dodaj_profesora($_POST['prof']);

    if($rezultat){
        echo "greska";
    } else {
       echo "radi";
    }
    

}


?>