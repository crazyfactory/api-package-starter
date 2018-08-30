<?php
namespace App\Tests\Unit\Models\mocks;

use App\Models\BaseModel;

class MockModel extends BaseModel
{

	public $id, $name, $status, $password;
	function hideOverHttp(): array
	{
		return [
			'password'
		];
	}

	function validate(): bool
	{
		return true;
	}
}
