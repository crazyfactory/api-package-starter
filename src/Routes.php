<?php

namespace App;

use App\Controllers\HealthController;
use App\Controllers\UserController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Routes
{
	public function __construct()
	{
	}

	public function registerRoutes(RouteCollection $routeCollection)
	{
		$routeCollection->add("test", new Route("/user/{id}/profile", ['_controller' => UserController::class . "::test"]));
		$routeCollection->add("health", new Route("/health", ['_controller' => HealthController::class . "::check"]));
		return $routeCollection;
	}
}
