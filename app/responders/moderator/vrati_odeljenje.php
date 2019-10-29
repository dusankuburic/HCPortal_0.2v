<?php
require_once("../../models/Odeljenje.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['odeljenje'])){

    
$odeljenje = new Odeljenje();
$odeljenje_sa_sifrom = $odeljenje->sa_sifrom($_POST['odeljenje']);

if($odeljenje_sa_sifrom){
    echo json_encode($odeljenje_sa_sifrom);
} 



}
    

?>