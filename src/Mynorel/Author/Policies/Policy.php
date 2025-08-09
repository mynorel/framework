<?php
namespace Mynorel\Author\Policies;

use Mynorel\Author\Contracts\PolicyInterface;

/**
 * Policy: Base class for all authorization policies in Mynorel.
 * Extend and implement enact($user, ...$args): bool.
 */
abstract class Policy implements PolicyInterface
{
    // Optionally, base logic for all policies
}
