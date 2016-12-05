<?php
use Application\Application;
use Application\Core\Config;

require dirname(__DIR__) . "/vendor/autoload.php";

$config = Config::buildConfigFromFile(dirname(__DIR__) . "/Application/Configs/config.json");
ini_set("display_errors", $config->getShowErrorsOption());
Application::launch($_SERVER, $_REQUEST);