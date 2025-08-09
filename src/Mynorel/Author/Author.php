<?php
namespace Mynorel\Author;

use Mynorel\Author\Roles\Role;
use Mynorel\Author\Policies\Policy;

/**
 * Author: Facade for defining and checking abilities in Mynorel's authorization layer.
 * Provides expressive, narrative-first API for permissions.
 */
class Author
{
    /**
     * Begin allowing an ability for a role.
     * @param string $ability
     * @return AuthorAbility
     */
    public static function allow(string $ability): AuthorAbility
    {
        return new AuthorAbility($ability, true);
    }

    /**
     * Begin denying an ability for a role.
     * @param string $ability
     * @return AuthorAbility
     */
    public static function deny(string $ability): AuthorAbility
    {
        return new AuthorAbility($ability, false);
    }

    /**
     * Begin checking if a user can perform an ability.
     * @param string $ability
     * @return AuthorUserAbility
     */
    public static function can(string $ability): AuthorUserAbility
    {
        return new AuthorUserAbility($ability);
    }
}

/**
 * AuthorAbility: Helper for chaining allow/deny to a role.
 */
class AuthorAbility
{
    protected string $ability;
    protected bool $allowed;

    /**
     * @param string $ability
     * @param bool $allowed
     */
    public function __construct(string $ability, bool $allowed)
    {
        $this->ability = $ability;
        $this->allowed = $allowed;
    }

    /**
     * Assign the ability to a role (allow or deny).
     * @param string $role
     */
    public function for(string $role): void
    {
        if ($this->allowed) {
            Gate::allow($this->ability, $role);
        } else {
            Gate::deny($this->ability, $role);
        }
    }
}

/**
 * AuthorUserAbility: Helper for chaining ability check to a user.
 */
class AuthorUserAbility
{
    protected string $ability;

    /**
     * @param string $ability
     */
    public function __construct(string $ability)
    {
        $this->ability = $ability;
    }

    /**
     * Check if the user can perform the ability.
     * @param mixed $user
     * @return bool
     */
    public function as($user): bool
    {
        return Gate::can($this->ability, $user);
    }
}
