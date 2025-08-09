<?php
namespace Mynorel\Narrative;

/**
 * Chapter: Encapsulates a narrative chapter (route).
 */

use Mynorel\Narrative\Character;

class Chapter
{
	public string $name;
	public ?string $controller = null;
	public array $middleware = [];
	public ?string $role = null;
	public ?Character $character = null;

	public function __construct(string $name, ?string $controller = null, array $middleware = [], ?string $role = null, ?Character $character = null)
	{
		$this->name = $name;
		$this->controller = $controller;
		$this->middleware = $middleware;
		$this->role = $role;
		$this->character = $character;
	}

	/**
	 * Get the character's evolution (if any).
	 */
	public function characterEvolution(): ?array
	{
		return $this->character ? $this->character->getEvolution() : null;
	}
}
