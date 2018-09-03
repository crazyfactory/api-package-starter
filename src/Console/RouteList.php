<?php
namespace App\Console;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RouteList extends BaseCommand
{
	public function configure()
	{
		$this->setName('route:list')
			->setDescription('display list of routes');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$registeredRoutes = $this->getRoutes();
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
