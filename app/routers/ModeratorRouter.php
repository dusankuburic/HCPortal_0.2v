<?php

if(isset($_SESSION['moderator'])){  

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
        require_once('../moderator/index.php');
        break;

        case 'pregled_odeljenja': 
        require_once('../moderator/odeljenja/pregled_odeljenja.php');
        break;

        case 'dodaj_odeljenje': 
        require_once('../moderator/odeljenja/dodaj_odeljenje.php');
        break;


        default:
        require_once('../moderator/index.php');
        break;

    }


} else {

    header("Location: ../../../index.php");
}



?>