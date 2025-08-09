<?php
namespace Mynorel\Chronicle;

/**
 * Chronicle: Facade for narrative logging in Mynorel.
 * Provides poetic, story-driven log methods.
 */
class Chronicle
{
	/**
	 * Log a general note (info-level).
	 * @param string $message
	 */
	public static function note(string $message): void
	{
		Writer::write('info', $message);
	}

	/**
	 * Log a warning (story interruption).
	 * @param string $message
	 */
	public static function warn(string $message): void
	{
		Writer::write('warn', $message);
	}

	/**
	 * Log a chapter event (major event in the story).
	 * @param string $message
	 */
	public static function chapter(string $message): void
	{
		Writer::write('chapter', $message);
	}

	/**
	 * Log an interruption (error-level event).
	 * @param string $message
	 */
	public static function interrupt(string $message): void
	{
		Writer::write('error', $message);
	}
}
