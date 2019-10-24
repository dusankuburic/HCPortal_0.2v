<?php


if(isset($_SESSION['ucenik'])){    

    if(isset($_GET['route']))
    {
        $route = $_GET['route'];
    }
    else 
    {
        $route = '';
    }

    switch($route){

        case 'pocetna':
        require_once('../ucenik/index.php');
        break;

        case 'svi_predmeti':
        require_once('../ucenik/predmeti/svi_predmeti.php');
        break;
        
        default:
        require_once('../ucenik/index.php');
        break;
        
    }


} else {

    header("Location: ../../../index.php");
}






?>