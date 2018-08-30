<?php

namespace App\Models;

class CategoryModel extends BaseModel
{

	public $name, $id, $status, $combinations;

	function validate(): bool
	{
		return true;
	}
}
