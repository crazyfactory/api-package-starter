<?php
namespace App\Console\Templates;

class Renderer
{
	public static function render(string $filename, array $data): string {
		$contents = file_get_contents($filename);
		foreach ($data as $key => $value) {
			$contents = str_replace('$' . $key . '$', $value, $contents);
		}
		return $contents;
	}
}
