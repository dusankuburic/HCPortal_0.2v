<?php
session_start();
require_once("../../models/Odeljenje.php");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_POST['odeljenje'])){

    
$odeljenje = new Odeljenje();
$odeljenje_sa_sifrom = $odeljenje->sa_sifrom($_POST['odeljenje']);

if(!$odeljenje_sa_sifrom){
    echo "../layouts/moderator.php?route=pocetna";
} else {


$_SESSION['sifra_odeljenja'] = $odeljenje_sa_sifrom['sifra_odeljenja'];

echo "../layouts/moderator.php?route=pregled_ucenika_za_upis_ocena&sifra=".$odeljenje_sa_sifrom['sifra_odeljenja'];

}

}
    

?>