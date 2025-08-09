<?php
namespace Mynorel\Services;

class ThemeService
{
	protected static array $palette = [
		'primary' => '#2B6CB0',
		'secondary' => '#68D391',
		'background' => '#F7FAFC',
	];

	protected static array $directives = [];

	public static function palette(): array
	{
		return self::$palette;
	}

	public static function get(string $key)
	{
		return self::$palette[$key] ?? null;
	}

	public static function registerDirectives(array $map): void
	{
		self::$directives = array_merge(self::$directives, $map);
	}
}
