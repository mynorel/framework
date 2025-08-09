<?php
namespace Mynorel\Manifest;

use Mynorel\Manifest\ManifestInterface;

/**
 * ThemeManifest: Describes available themes and palettes.
 */
class ThemeManifest implements ManifestInterface
{
	public static function themes(): array
	{
		// Return a list of available themes and their palettes
		return [];
	}
}
