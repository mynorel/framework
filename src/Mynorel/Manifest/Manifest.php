<?php

namespace Mynorel\Manifest;

class Manifest
{
	protected static array $data = [];

	/**
	 * Load the mynorel.json manifest file.
	 * @param string $path
	 */
	public static function load(string $path = 'mynorel.json'): void
	{
		$json = file_get_contents($path);
		static::$data = json_decode($json, true);
	}

	/**
	 * Get the modules defined in the manifest.
	 * @return array
	 */
	public static function modules(): array
	{
		return static::$data['modules'] ?? [];
	}

	/**
	 * Get the philosophy section from the manifest.
	 * @return array
	 */
	public static function philosophy(): array
	{
		return static::$data['philosophy'] ?? [];
	}

	/**
	 * Get a human-readable description of the framework's philosophy.
	 * @return string
	 */
	public static function describe(): string
	{
		$lines = [];
		foreach (static::philosophy() as $key => $value) {
			$lines[] = ucfirst($key) . ': ' . $value;
		}
		return implode(PHP_EOL, $lines);
	}
}
