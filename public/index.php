<?php
require_once __DIR__ . "/../vendor/autoload.php";
$applicationManager = new \App\Mocks\MockApplicationManager();
ini_set("display_errors", 1);
$app = new \App\App($applicationManager);
$app->handle();
