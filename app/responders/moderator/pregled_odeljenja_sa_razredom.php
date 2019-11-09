<?php
require_once("../../models/Odeljenje.php");
header("Content-Type: application/json; charset=UTF-8");




if(isset($_POST['razred'])){

    $odeljenje = new Odeljenje();
    $sva_odeljenja_sa_razredom = $odeljenje->sva_odeljenja_sa_razredom($_POST['razred']);
    echo json_encode($sva_odeljenja_sa_razredom);
    exit;
}
    

?>