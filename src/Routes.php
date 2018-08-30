<?php
namespace App;

use App\Controller\TestController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Routes
{
	public function __construct()
	{
	}

	public function registerRoutes(RouteCollection $routeCollection) {
		$routeCollection->add("test", new Route("/path", ['_controller' => [TestController::class, "test"]]));
		$routeCollection->add("test", new Route("/user/{id}/profile", ['_controller' => TestController::class . "::test"]));
		return $routeCollection;
	}
}
