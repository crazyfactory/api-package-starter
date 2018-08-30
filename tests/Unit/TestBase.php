<?php
namespace App\Tests\Unit;

use App\Di\Di;
use PHPUnit\Framework\TestCase;

class TestBase extends TestCase
{
	/**
	 * @var Di $di
	 */
	protected $di;

	/**
	 * TestBase constructor.
	 * @param null|string $name
	 * @param array $data
	 * @param string $dataName
	 * @throws \Exception
	 */
	public function __construct(?string $name = null, array $data = [], string $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
		$this->di = Di::getInstance();
	}

}