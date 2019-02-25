<?php
require_once(__DIR__.'/config.php');
require_once(__DIR__.'/autoload.php');
require_once(__DIR__.'/dump.php');

use App\Core\CodeGenerator;
use App\Controller;

$controller = new Controller();
$result = $controller->controller(16);

dump($result);