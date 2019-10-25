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


        case 'pregled_predmeta': 
        require_once('../moderator/predmeti/pregled_predmeta.php');
        break;

        case 'dodaj_predmet': 
        require_once('../moderator/predmeti/dodaj_predmet.php');
        break;


        case 'pregled_moderatora': 
        require_once('../moderator/moderatori/pregled_moderatora.php');
        break;

        case 'dodaj_moderatora': 
        require_once('../moderator/moderatori/dodaj_moderatora.php');
        break;


        default:
        require_once('../moderator/index.php');
        break;

    }


} else {

    header("Location: ../../../index.php");
}



?>