<?php
require_once __DIR__ . '/../config/loader.php'; 
require_once __DIR__ . '/../config/session.php'; 
require_once __DIR__ . '/../config/config.php'; 
require_once __DIR__ . '/../models/User.php'; 
session_start();
requireValidSession(true);


loadModel('WorkingHours');

$activeUserCount = User::getActiveUsersCount();
$absentUsers = WorkingHours::getAbsentUsers();

$yearAndMonth = (new DateTime())->format('Y-m');
$seconds = WorkingHours::getWorkedTimeInMonth($yearAndMonth);
$hoursInMonth = explode(':', getTimeStringFromSeconds($seconds))[0];

loadTemplateView('manager_report', [
    'activeUserCount' => $activeUserCount,
    'absentUsers' => $absentUsers,
    'hoursInMonth' => $hoursInMonth,

]);