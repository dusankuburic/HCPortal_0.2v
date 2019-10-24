<?php
if(isset($_SESSION['profesor'])){  

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
        require_once('../profesor/index.php');
        break;


        default:
        require_once('../profesor/index.php');
        break;

    }


} else {

    header("Location: ../../../index.php");
}



?>