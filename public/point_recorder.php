<?php
require_once __DIR__ . '/../src/config/loader.php';
require_once __DIR__ . '/../src/models/User.php'; 
session_start();

if(!isset($_SESSION['user'])){
    header("Location: index.php");
}


loadModel('WorkingHours');

$date =(new DateTime())->getTimestamp();
$today = (new DateTime())->format('d \d\e F \d\e Y');

$user = $_SESSION['user'];
$records = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));

loadTemplateView('day_records', ['today' => $today, 'records' => $records]);



