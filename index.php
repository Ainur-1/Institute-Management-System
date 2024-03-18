<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startupf_errors', 1);

require_once 'app/core/Router.php';

$router = new Router();
$router->route();