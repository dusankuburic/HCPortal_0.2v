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

        /** ODELJENJA */
        case 'pregled_odeljenja': 
        require_once('../moderator/odeljenja/pregled_odeljenja.php');
        break;

        case 'dodaj_odeljenje': 
        require_once('../moderator/odeljenja/dodaj_odeljenje.php');
        break;

        case 'izmeni_odeljenje': 
        require_once('../moderator/odeljenja/izmeni_odeljenje.php');
        break;

        /** PREDMETI */
        case 'pregled_predmeta': 
        require_once('../moderator/predmeti/pregled_predmeta.php');
        break;

        case 'dodaj_predmet': 
        require_once('../moderator/predmeti/dodaj_predmet.php');
        break;

        case 'izmeni_predmet': 
        require_once('../moderator/predmeti/izmeni_predmet.php');
        break;

        /** MODERATORI */
        case 'pregled_moderatora': 
        require_once('../moderator/moderatori/pregled_moderatora.php');
        break;

        case 'dodaj_moderatora': 
        require_once('../moderator/moderatori/dodaj_moderatora.php');
        break;

        case 'izmeni_moderatora': 
        require_once('../moderator/moderatori/izmeni_moderatora.php');
        break;

        /** PROFESORI */
        case 'pregled_profesora': 
        require_once('../moderator/profesori/pregled_profesora.php');
        break;

        case 'dodaj_profesora': 
        require_once('../moderator/profesori/dodaj_profesora.php');
        break;

        case 'izmeni_profesora': 
        require_once('../moderator/profesori/izmeni_profesora.php');
        break;

        /** UCENICI */
        case 'pregled_ucenika': 
        require_once('../moderator/ucenici/pregled_ucenika.php');
        break;

        case 'dodaj_ucenika': 
        require_once('../moderator/ucenici/dodaj_ucenika.php');
        break;


        case 'izmeni_ucenika': 
        require_once('../moderator/ucenici/izmeni_ucenika.php');
        break;


        /** UPIS OCENA */
        case 'upis_ocena': 
        require_once('../moderator/pages/upis_ocena.php');
        break;

        case 'pregled_odeljenja_za_upis_ocena': 
        require_once('../moderator/pages/pregled_odeljenja.php');
        break;

        case 'pregled_ucenika_za_upis_ocena': 
        require_once('../moderator/pages/pregled_ucenika.php');
        break;

        case 'pregled_predmeta_ucenika': 
        require_once('../moderator/pages/pregled_predmeta_ucenika.php');
        break;

        case 'pregled_ocena_ucenika': 
        require_once('../moderator/pages/pregled_ocena_ucenika.php');
        break;

        default:
        require_once('../moderator/index.php');
        break;

    }


} else {

    header("Location: ../../../index.php");
}



?>