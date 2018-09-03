<?php

use App\Console\MakeCommand;
use App\Console\MakeController;
use App\Console\RouteList;
use App\Console\Sdk;
use Symfony\Component\Console\Application;

require_once __DIR__ . "/vendor/autoload.php";
$composer_json = json_decode(file_get_contents(__DIR__ . "/composer.json"), true);
$app = new Application($composer_json['name']?? 'No Name', $composer_json['version'] ?? 'xxx');
$app->add(new RouteList());
$app->add(new Sdk());
$app->add(new MakeController());
$app->add(new MakeCommand());
$app->run();
