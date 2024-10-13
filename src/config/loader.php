<?php
// Definindo TEMPLATE_PATH no início do loader.php

define('TEMPLATE_PATH', __DIR__ . '/../views/templates/');
define('VIEW_PATH', __DIR__ . '/../views/');
define('MODEL_PATH', __DIR__ . '/../models/');

function loadModel($modelName) {
    require_once(MODEL_PATH . '/Model.php');
    require_once(MODEL_PATH . '/' . $modelName . '.php');
}

function loadView($viewName, $params = array()) {
    if(count($params) > 0){
        foreach($params as $key => $value){
            if(strlen($key) > 0){
                ${$key} = $value;
            }
        }
    }
    require_once(VIEW_PATH . '/' . $viewName . '.php');
}

function loadTemplateView($viewName, $params = array()) {
    if(count($params) > 0){
        foreach($params as $key => $value){
            if(strlen($key) > 0){
                ${$key} = $value;
            }
        }
    }
    
    $user = $_SESSION['user'];
    $workingHours = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));
    $workedInterval = $workingHours->getWorkdInterval()->format('%H:%I:%S');
    $exitTime = $workingHours->getExitTime()->format('H:i:s');
    $activeClock = $workingHours->getActiveClock();

    require_once(TEMPLATE_PATH . '/header.php');
    require_once(TEMPLATE_PATH . '/left.php');
    require_once(VIEW_PATH . '/' . $viewName . '.php');
    require_once(TEMPLATE_PATH . '/footer.php');


}
