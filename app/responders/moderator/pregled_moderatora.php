<?php
require_once("../../models/Database.php");
require_once("../../repositories/ModeratorRepository.php");
header("Content-Type: application/json; charset=UTF-8");

$moderatorRepository = new ModeratorRepository(new Database());
$svi_moderatori = $moderatorRepository->svi_moderatori();
echo json_encode($svi_moderatori);
?>