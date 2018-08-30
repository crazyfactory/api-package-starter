<?php
namespace App\Tests\Unit\Models;

use App\Models\CategoryModel;
use PHPUnit\Framework\TestCase;

class CategoryModelTest extends TestCase
{

	public function testValidate()
	{
		$categoryModel = new CategoryModel();
		$this->assertTrue($categoryModel->validate());
	}
}
