<?php
namespace App\Console;

use App\Console\Templates\Renderer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MakeController extends BaseCommand
{
	public function configure()
	{
		$this->setName('make:controller')
			->setDescription('generate a controller');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$question = new Question("Enter Controller name: ");
		$helper = $this->getHelper("question");
		$name = $helper->ask($input, $output, $question);
		$contents = Renderer::render(__DIR__ . "/Stubs/Controller.php.stub", ['NAME' => $name]);
		$file_path = __DIR__ . '/../Controllers/' . $name . '.php';
		if (file_exists($file_path)) {
			$output->writeln("File already exists");
			return;
		}
		file_put_contents($file_path, $contents);
	}
}
