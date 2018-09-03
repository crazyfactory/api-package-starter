<?php

namespace App\Console;

use App\Console\Schemas\Api;
use App\Console\Schemas\Model;
use App\Console\Schemas\ModelProperty;
use App\Models\BaseModel;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\Route;

class Sdk extends BaseCommand
{
	public function configure()
	{
		$this->setName('sdk:generate')
			->setDescription('generate sdk definition');
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$models = $this->generateModelsSchema();
		print_r($models);
		$this->generateApiSchema();
		// now we also need to generate schema for api.
	}

	protected function generateApiSchema() {
		$routes = $this->getRoutes();
		$method = $this->getTargetMethod('test', $routes['test']);
		var_dump($method->getReturnType()->getName());
	}

	protected function getTargetMethod($name, Route $route) {
		$target = $route->getDefault('_controller');
		$api = new Api();
		$api->name = $name;
		$api->method = $route->getMethods();
		return new \ReflectionMethod($target);
	}

	/**
	 * @return Model[]
	 */
	protected function generateModelsSchema() {
		$models = $this->getAllModels();
		$data = array_map(function ($model) {
			return $this->getModelData($model);
		}, $models);
		return $data;
	}

	protected function getModelData($modelName): Model {
		$properties = $this->getPropertiesFromModel($modelName);
		$baseName = explode('\\', $modelName);
		$className = end($baseName);
		$model = new Model();
		$model->model_name = $className;
		$model->properties = $properties;
		return $model;
	}

	/**
	 * @param $class
	 * @return ModelProperty[]
	 */
	protected function getPropertiesFromModel($class) {
		$vars = get_class_vars($class);
		$vars = array_keys($vars);
		return array_map(function ($var) {
			$prop = new ModelProperty();
			$prop->name = $var;
			$prop->optional = true;
			$prop->type = 'mixed';
			return $prop;
		}, $vars);
	}

	protected function getAllModels()
	{
		$modelDir = __DIR__ . "/../Models/";
		$files = $this->getFilesFromDir($modelDir);
		$classes = array_map(function ($file) use ($modelDir) {
			return "App\Models\\" . pathinfo($modelDir . $file, PATHINFO_FILENAME);
		}, $files);
		return array_filter($classes, function($class) {
			return class_exists($class) && is_subclass_of($class, BaseModel::class);
		});
	}

	protected function getFilesFromDir(string $dir)
	{
		return array_filter(scandir($dir), function ($item) {
			return $item !== "." && $item !== "..";
		});
	}
}
