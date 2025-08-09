<?php
namespace Mynorel\Narrative;

/**
 * StoryMap: Registry/visual map of all chapters.
 */
class StoryMap
{
	protected static array $chapters = [];

	public static function addChapter(Chapter $chapter): void
	{
		self::$chapters[$chapter->name] = $chapter;
	}

	public static function all(): array
	{
		return self::$chapters;
	}

	public static function find(string $name): ?Chapter
	{
		return self::$chapters[$name] ?? null;
	}
}
