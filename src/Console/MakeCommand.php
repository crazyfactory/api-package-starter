<?php

namespace App\Console;

use App\Console\Templates\Renderer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MakeCommand extends BaseCommand
{
	public function configure()
	{
		$this->setName('make:command')
			->setDescription('generate a command');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$helper = $this->getHelper("question");
		$name = $helper->ask($input, $output, new Question("Enter command name: "));
		$className = $this->getClassNameFromCommandName($name);
		$filename = __DIR__ . '/' . $className . '.php';
		if (file_exists($filename)) {
			$output->writeln("command already exists");
			return;
		}
		$description = $helper->ask($input, $output, new Question("Enter command description: "));
		$contents = Renderer::render(__DIR__ . '/Stubs/Command.php.stub', [
			'NAME' => $name,
			'DESCRIPTION' => $description,
			'CLASS' => $className
		]);
		file_put_contents($filename, $contents);
		$output->writeln("Register $name to ./crazy.php");
	}

	protected function getClassNameFromCommandName(string $name) {
		$parts = explode(":", $name);
		$parts = array_map(function($part) {
			return ucwords($part);
		}, $parts);
		return implode("", $parts);
	}
}
