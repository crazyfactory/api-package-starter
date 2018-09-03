<?php
namespace App\Console;

use App\Routes;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Routing\RouteCollection;

abstract class BaseCommand extends Command
{
	/**
	 * @return \Symfony\Component\Routing\Route[]
	 */
	protected function getRoutes() {
		$routeCollection = new RouteCollection();
		$routes = new Routes();
		$routes->registerRoutes($routeCollection);
		return $routeCollection->all();
	}
}