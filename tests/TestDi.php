<?php
namespace App\Tests;

use App\Di\Di;

class TestDi
{
	private static $instance;
	private $di;

	public static function getInstance(): TestDi {
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	public function __construct()
	{
		$this->di = Di::getInstance();
	}

	public $resources;
	public function replaceInstance($id, $instance) {
		// here, save to resources.
		try {
			$this->resources[$id] = $this->di->get($id);
		} catch (\Exception $exception) {
			$this->resources[$id] = null;
		}
		$this->di->set($id, $instance);
	}
	public function restore($id) {
		if (!$this->resources[$id] === null) {
			$this->di->set($id, $this->resources[$id]);
		}
		unset($this->resources[$id]);
	}
	public function replaceService($id, $class) {
		try {
			$this->resources[$id] = $this->di->get($id);
		} catch (\Exception $exception) {
			$this->resources[$id] = null;
		}
		$this->di->register($id, $class);
	}
}
