<?php
require_once("../../models/Ucenik.php");
header("Content-Type: application/json; charset=UTF-8");




if(isset($_POST['ucen'])){

    $ucenik = new Ucenik();
    $predmeti_koje_uci = $ucenik->predmeti_koje_uci($_POST['ucen']);
    echo json_encode($predmeti_koje_uci);
    exit;
}
    

?>