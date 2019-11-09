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

echo "../layouts/moderator.php?route=izmeni_odeljenje&sifra=".$odeljenje_sa_sifrom['sifra_odeljenja'];
//echo json_encode($odeljenje_sa_sifrom);

}
exit;
}
    

?>