<?php
namespace Mynorel\Manifest;

use Mynorel\Manifest\ManifestInterface;

/**
 * OnboardingManifest: Describes onboarding flows and guides.
 */
class OnboardingManifest implements ManifestInterface
{
	public static function guides(): array
	{
		// Return a list of onboarding guides or steps
		return [];
	}
}
