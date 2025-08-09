<?php
namespace Mynorel\Author\Contracts;

/**
 * PolicyInterface: Contract for all authorization policies.
 * Implement enact($user, ...$args): bool to define access logic.
 */
interface PolicyInterface
{
    /**
     * Determine if the user can perform the action.
     * @param mixed $user
     * @param mixed ...$args
     * @return bool
     */
    public function enact($user, ...$args): bool;
}
