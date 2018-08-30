<?php
namespace App\Models;

abstract class BaseModel implements Wirable
{
	public function hideOverHttp(): array {
		return [];
	}
	abstract function validate(): bool;

	public function __toString(): string
	{
		$properties = get_object_vars($this);
		$hidden = $this->hideOverHttp();
		$properties = array_filter($properties, function($key) use ($hidden) {
			return !in_array($key, $hidden);
		}, ARRAY_FILTER_USE_KEY);
		return json_encode($properties);
	}

	public function __fromString(string $string): void
	{
		$jsonContent = json_decode($string, true);
		foreach ($jsonContent as $key => $value) {
			$this->$key = $value;
		}
	}
}
