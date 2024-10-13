<?php
require_once __DIR__ . '/../config/loader.php';
require_once __DIR__ . '/../config/dataBase.php'; 
require_once __DIR__ . '/../config/date_utils.php'; 
loadModel('WorkingHours');

define('DAILY_TIME', 8 * 60 * 60);

DataBase::executeSQL('DELETE FROM working_hours');

function getDayTemplateByOdds($regularRate, $extraRate, $lazyRate)
{
    $regularDayTemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '17:00:00',
        'worked_time' => DAILY_TIME
    ];

    $extraHourDayTemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '18:00:00',
        'worked_time' => DAILY_TIME + 3600
    ];

    $lazyDayTemplate = [
        'time1' => '08:30:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '17:00:00',
        'worked_time' => DAILY_TIME - 1800
    ];
    $value = rand(0, 100);
    if($value <= $regularRate){
        return $regularDayTemplate;
    }elseif($value <= $regularRate = $extraRate){
        return $extraHourDayTemplate;
    }else{
        return $lazyDayTemplate;
    }
    print_r(getDayTemplateByOdds(33, 33, 34));
}
function populateWorkHours($userId, $initialDate, $regularRate, $extraRate, $lazyRate){
    $currentDate = $initialDate;
    $today = new DateTime();
    $columns = ['user_id' => $userId, 'work_date' => $currentDate];

    while(isBefore($currentDate, $today)){
        if(!isWeekend($currentDate)){
            $template = getDayTemplateByOdds($regularRate, $extraRate, $lazyRate);
            $columns = array_merge($columns, $template);
            $workingHours = new WorkingHours($columns);
            $workingHours->insert();
        }
        $currentDate = getNextDay($currentDate)->format('Y-m-d');
        $columns['work_date'] = $currentDate;
    }
}
$lastMonth = strtotime('first day last month');
populateWorkHours(1, date('Y-m-1'), 70, 20, 10);
populateWorkHours(3, date('Y-m-d', $lastMonth), 20, 75, 5);
populateWorkHours(4, date('Y-m-d', $lastMonth), 20, 10, 70);
echo "deu certo";