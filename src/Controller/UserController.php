<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;

class UserController extends BaseController
{
	/**
	 * @param Request $request
	 * @param $id
	 * @return array
	 */
	public function test(Request $request, $id) {
		return ['key' => $request->request->get("message")];
	}
};
