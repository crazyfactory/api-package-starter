<?php
namespace App\Console;

use App\Routes;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\RouteCollection;

class RouteList extends Command
{
	public function configure()
	{
		$this->setName('route:list')
			->setDescription('display list of routes');
	}
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$routeCollection = new RouteCollection();
		$routes = new Routes();
		$routes->registerRoutes($routeCollection);
		$registeredRoutes = $routeCollection->all();
		$table = new Table($output);
		$table->setHeaders(['name', 'uri', 'method', 'action']);
		$i = 1;
		foreach ($registeredRoutes as $key => $registeredRoute) {
			$row = [
				$key,
				$registeredRoute->getPath(),
				implode("|", $registeredRoute->getMethods()),
				$registeredRoute->getDefault('_controller')
			];
			$table->setRow($i++, $row);
		}
		$table->render();
	}
}
