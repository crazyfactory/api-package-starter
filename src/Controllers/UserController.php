<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use Symfony\Component\HttpFoundation\Request;

class UserController extends BaseController
{
	/**
	 * @param Request $request
	 * @param $id
	 * @return CategoryModel
	 * @throws \Exception
	 */
	public function test(Request $request, $id): CategoryModel
	{
		$model = new CategoryModel();
		$model->combinations = $this->di->resolveCombinationManager()->getCombinations($id);
		$model->status = false;
		$model->id = 3;
		$model->name = $request->request->get("name");
		return $model;
	}
}
