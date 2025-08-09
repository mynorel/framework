<?php
namespace Mynorel\Services;

class DirectiveCompiler
{
	protected static array $directives = [];

	public static function compile(string $name, callable $handler): void
	{
		self::$directives[$name] = $handler;
	}

	public static function register(array $directives): void
	{
		self::$directives = array_merge(self::$directives, $directives);
	}
}
