<?php
require_once __DIR__ . '/../config/loader.php'; 
require_once __DIR__ . '/../models/User.php'; 
session_start();
loadModel('WorkingHours');

$date =(new DateTime())->getTimestamp();
//$today = strftime('%d de %B de %Y', $date);
$today = (new DateTime())->format('d \d\e F \d\e Y');


loadTemplateView('day_records', ['today' => $today]);

