<?php
session_start();
require_once("../../models/Moderator.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['moderat'])){

    
$moderator = new Moderator();
$moderator_sa_sifrom = $moderator->sa_sifrom($_POST['moderat']);

if(!$moderator_sa_sifrom){
    echo "../layouts/moderator.php?route=pocetna";
} else {


$_SESSION['sifra_moderatora'] = $moderator_sa_sifrom['sifra_moderatora'];

echo "../layouts/moderator.php?route=izmeni_moderatora&sifra=".$moderator_sa_sifrom['sifra_moderatora'];

}
exit;
}
    

?>