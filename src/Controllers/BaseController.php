<?php
namespace App\Controllers;

use App\Di\Di;

abstract class BaseController
{
	/**
	 * @var Di $di
	 */
	protected $di;

	/**
	 * BaseController constructor.
	 * @throws \Exception
	 */
	public function __construct()
	{
		$this->di = Di::getInstance();
	}

}