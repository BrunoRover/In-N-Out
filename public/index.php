<?php

require_once(dirname(__FILE__, 2) . '/src/config/config.php');
require_once(CONTROLLER_PATH . "/login.php");


$uri = urldecode($_SERVER['REQUEST_URI'],);

//if($uri === '/' || $uri === '' || $uri === '/index.php'){
//    $uri = '/login.php';
//}

//require_once(CONTROLLER_PATH . "/{$uri}");
//require_once(CONTROLLER_PATH . "/day_records.php");



