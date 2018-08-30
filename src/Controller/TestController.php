<?php
namespace App\Controller;

use App\Di\Di;

class TestController
{
	/**
	 * @param $id
	 * @return array
	 * @throws \Exception
	 */
	public function test($id) {
		$di = Di::getInstance();
		return $di->resolveCategoryManager()->getCategories();
	}
};
