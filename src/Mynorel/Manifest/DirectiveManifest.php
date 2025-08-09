<?php
namespace Mynorel\Manifest;

use Mynorel\Manifest\ManifestInterface;

/**
 * DirectiveManifest: Describes available directives and their handlers.
 */
class DirectiveManifest implements ManifestInterface
{
	public static function all(): array
	{
		// Return a list of available directives and their handlers
		return [];
	}
}
