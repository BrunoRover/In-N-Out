<?php

date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt-BR', 'pt-BR.utf-8', 'portuguese');

// Defina o caminho para o diretório de modelos
define('MODEL_PATH', __DIR__ . '/../models');

// Defina o caminho para o diretório de visualizações
define('VIEW_PATH', __DIR__ . '/../views');

// Defina o caminho para o diretório de templates
define('TEMPLATE_PATH', __DIR__ . '/../views/templates');

// Defina o caminho para o diretório de controladores
define('CONTROLLER_PATH', __DIR__ . '/../controllers');

// Defina o caminho para o diretório de exceções
define('EXCEPTION_PATH', __DIR__ . '/../exceptions');

define('DAILY_TIME', 60 * 60 * 8);
// Arquivos
require_once(dirname(__FILE__) . '/database.php');
require_once(dirname(__FILE__) . '/loader.php');
require_once(dirname(__FILE__) . '/session.php');
require_once(dirname(__FILE__) . '/date_utils.php');
require_once(dirname(__FILE__) . '/utils.php');
require_once(MODEL_PATH . '/Model.php');
require_once(MODEL_PATH . '/User.php');

// Incluindo arquivos de exceção
require_once(EXCEPTION_PATH . '/AppException.php');
require_once(EXCEPTION_PATH . '/ValidationException.php');

//php_value error_reporting 0
//php_flag display_errors Off
