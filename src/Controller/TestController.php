<?php
namespace App\Controller;

class TestController extends BaseController
{
	/**
	 * @param $id
	 * @return array
	 * @throws \Exception
	 */
	public function test($id) {
		return $this->di->resolveCategoryManager()->getCategories();
	}
};
