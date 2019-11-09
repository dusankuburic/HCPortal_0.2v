<?php
require_once("../../models/Moderator.php");
header("Content-Type: application/json; charset=UTF-8");


$moderator = new Moderator();
$svi_moderatori = $moderator->svi_moderatori();
echo json_encode($svi_moderatori);
exit;   

?>