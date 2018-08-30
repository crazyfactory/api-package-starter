<?php
require_once __DIR__ . "/../vendor/autoload.php";
$applicationManager = new \App\Mocks\MockApplicationManager();
$app = new App\App($applicationManager);
$app->handle();
