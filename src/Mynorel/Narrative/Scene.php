<?php
namespace Mynorel\Narrative;

/**
 * Scene: Represents a controller-like unit of story.
 */
class Scene
{
	public string $name;
	public $handler;

	public function __construct(string $name, $handler)
	{
		$this->name = $name;
		$this->handler = $handler;
	}

	public function __invoke(...$args)
	{
		return call_user_func($this->handler, ...$args);
	}
}
