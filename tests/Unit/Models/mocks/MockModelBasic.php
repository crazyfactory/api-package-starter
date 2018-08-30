<?php
namespace App\Tests\Unit\Models\mocks;

use App\Models\BaseModel;

class MockModelBasic extends BaseModel
{
	public $name, $email;

	function validate(): bool
	{
		return false;
	}
}
