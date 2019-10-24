<?php

    if(isset($_GET['route']))
    {
        $route = $_GET['route'];
    }
    else 
    {
        $route = '';
    }

    switch($route){

        case 'prijava_ucenik':
        require_once('../pages/prijava_ucenik.php');
        break;

        case 'prijava_profesor':
        require_once('../pages/prijava_profesor.php');
        break;

        case 'prijava_moderator':
        require_once('../pages/prijava_moderator.php');
        break;


        default:
        header("Location: ../../../index.php");
        break;

    }

?>