<?php
require_once __DIR__ . '/../config/loader.php'; 
require_once __DIR__ . '/../config/utils.php'; 
require_once __DIR__ . '/../models/User.php'; 
session_start();

loadModel('WorkingHours');

$user = $_SESSION['user'];
$records =  WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));

try{
    $currentTime = (new DateTime())->format('H:i:s');
    $records->innout($currentTime);
    addSuccessMsg("Ponto inserido com suscesso!");
}catch(AppException $e){
    addErrorMsg($e->getMessage());
}

header("Location: ../../public/point_recorder.php");