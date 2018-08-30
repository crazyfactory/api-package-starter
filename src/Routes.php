<?php

namespace App;

use App\Controllers\HealthController;
use App\Controllers\UserController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Routes
{
	public function registerRoutes(RouteCollection $routeCollection)
	{
		$routeCollection->add("test", $this->get('/user/{id}/profile', UserController::class, 'test'));
		$routeCollection->add("health", $this->get('/health', HealthController::class, 'check'));
		return $routeCollection;
	}

	private function get(string $path, string $controller, string $method)
	{
		return $this->withVerb($path, $controller, $method, ['GET']);
	}

	private function post(string $path, string $controller, string $method)
	{
		return $this->withVerb($path, $controller, $method, ['POST']);
	}

	private function delete(string $path, string $controller, string $method)
	{
		return $this->withVerb($path, $controller, $method, ['DELETE']);
	}

	private function patch(string $path, string $controller, string $method)
	{
		return $this->withVerb($path, $controller, $method, ['PATCH']);
	}

	private function withVerb(string $path, string $controller, string $method, array $verb = [])
	{
		return new Route($path, ['_controller' => $controller . '::' . $method], [], [], null, [], $verb);
	}
}
