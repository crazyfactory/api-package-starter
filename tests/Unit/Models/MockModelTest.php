<?php
/**
 * Created by PhpStorm.
 * User: cyberkiller
 * Date: 8/30/18
 * Time: 10:27 AM
 */

namespace App\Tests\Unit\Models;

use App\Tests\Unit\Models\mocks\MockModel;
use PHPUnit\Framework\TestCase;

class MockModelTest extends TestCase
{
	public function testValidate(){
		$model = new MockModel();
		$this->assertTrue($model->validate());
	}
	public function testToJson() {
		$model = new MockModel();
		$model->id = 1;
		$model->status = false;
		$model->name = "plugs";
		$jsonContent = json_decode($model->__toString(), true);
		$this->assertEquals($jsonContent['name'], "plugs");
		$this->assertEquals($jsonContent['id'], 1);
		$this->assertEquals($jsonContent['status'], false);
	}
	public function testToJsonHidesSensitiveData() {
		$model = new MockModel();
		$model->id = 1;
		$model->status = true;
		$model->name = "plugs";
		$model->password = "myPassword";
		$json = json_decode($model->__toString(), true);
		$this->assertArrayNotHasKey('password', $json);
	}
	public function testFromJson() {
		$model = new MockModel();
		$model->__fromString('{"name": "plugs", "id": 1, "status": true}');
		$this->assertTrue($model->status);
		$this->assertEquals($model->name, "plugs");
		$this->assertEquals($model->id, 1);
	}
}
