<?php
session_start();

require_once __DIR__ . '/../config/loader.php'; 
require_once __DIR__ . '/../config/session.php'; 
require_once __DIR__ . '/../config/config.php'; 
require_once __DIR__ . '/../models/User.php'; 

loadModel('WorkingHours');
$currentDate = new DateTime();

$user = $_SESSION['user'];
$selectedUser = $_SESSION['user']->id;
$users = null;
if($user->is_admin){
    $user = User::get();
    $selectedUser = $_POST['user'] ? $_POST['user'] : $user[0]->id;
}

$selectedPeriod = isset($_POST['period']) ? $_POST['period'] : $currentDate->format('Y-m');
$periods = [];
$fmt = new IntlDateFormatter('pt_BR', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'America/Sao_Paulo', IntlDateFormatter::GREGORIAN, 'MMMM yyyy');
for ($yearDiff = 0; $yearDiff <= 2; $yearDiff++) {
    $year = date('Y') - $yearDiff;
    for ($month = 12; $month >= 1; $month--) {
        $date = new DateTime("{$year}-{$month}-01");
        $periods[$date->format('Y-m')] = $fmt->format($date);
    }
}
$registries = WorkingHours::getMonthlyReport($selectedUser, $selectedPeriod);

$report = [];
$workDay = 0;
$sumOfWorkedTime = 0;
$lastDay = getLastDayOfMonth($selectedPeriod)->format('d');

for($day = 1; $day <= $lastDay; $day++){
    $date = $selectedPeriod . '-' . sprintf('%02d', $day);
    //$registry = $registries[$date];]
    if (isset($registries[$date])) {
        $registry = $registries[$date];
    } else {
        $registry = null;
    }

    if(isPastWorkday($date)) $workDay++;

    if($registry){
        $sumOfWorkedTime += $registry->worked_time;
        array_push($report, $registry);
    }else{
        array_push($report, new WorkingHours([
            'work_date' => $date,
            'worked_time' => 0
        ]));

    }
}
$expectedTime = $workDay * DAILY_TIME;
$balance = getTimeStringFromSeconds(abs($sumOfWorkedTime - $expectedTime));
$sing = ($sumOfWorkedTime >= $expectedTime) ? '+' : '-';


loadTemplateView('monfly_report', [
   'report' => $report,
   'sumOfWorkedTime' => getTimeStringFromSeconds($sumOfWorkedTime),
    'balance' => "{$sing}{$balance}",
    'selectedPeriod' => $selectedPeriod,
    'periods' => $periods,
    'users' => $users,
    'selectedUser'=> $selectedUser,
]);
