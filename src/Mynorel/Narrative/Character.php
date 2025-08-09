<?php
namespace Mynorel\Narrative;

/**
 * Character: Defines a role/archetype in the narrative.
 */

class Character
{
	public string $name;
	public array $traits;
	protected array $evolution = [];

	public function __construct(string $name, array $traits = [])
	{
		$this->name = $name;
		$this->traits = $traits;
		$this->evolution[] = ['traits' => $traits, 'at' => time()];
	}

	/**
	 * Evolve the character by changing or adding traits.
	 * @param array $newTraits
	 * @param string|null $reason
	 */
	public function evolve(array $newTraits, ?string $reason = null): void
	{
		$this->traits = array_merge($this->traits, $newTraits);
		$this->evolution[] = [
			'traits' => $this->traits,
			'at' => time(),
			'reason' => $reason
		];
	}

	/**
	 * Get the evolution history of the character.
	 * @return array
	 */
	public function getEvolution(): array
	{
		return $this->evolution;
	}
}
