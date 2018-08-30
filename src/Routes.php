<?php
namespace App;

use App\Controller\UserController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Routes
{
	public function __construct()
	{
	}

	public function registerRoutes(RouteCollection $routeCollection) {
		$routeCollection->add("test", new Route("/path", ['_controller' => [UserController::class, "test"]]));
		$routeCollection->add("test", new Route("/user/{id}/profile", ['_controller' => UserController::class . "::test"]));
		return $routeCollection;
	}
}
