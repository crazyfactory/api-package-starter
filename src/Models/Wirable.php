<?php

namespace App\Models;

interface Wirable
{
	public function __toString(): string;

	public function __fromString(string $string);
}
