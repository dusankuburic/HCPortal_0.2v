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


        default:
        require_once('../moderator/index.php');
        break;

    }


} else {

    header("Location: ../../../index.php");
}



?>