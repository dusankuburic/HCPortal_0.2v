<?php
require_once("../../models/Predmet.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['predmet'])){

    
$predmet = new Predmet();
$predmet_sa_sifrom = $predmet->sa_sifrom($_POST['predmet']);

if($predmet_sa_sifrom){
    echo json_encode($predmet_sa_sifrom);
} 



}
    

?>