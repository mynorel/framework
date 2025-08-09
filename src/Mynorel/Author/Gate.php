<?php
namespace Mynorel\Author;

use Mynorel\Author\Roles\Role;
use Mynorel\Chronicle\Chronicle;
use Mynorel\Author\Contracts\PolicyInterface;

/**
 * Gate: Internal registry and checker for Mynorel's authorization layer.
 * Handles permission/denial rules, policy callbacks, policy classes, and ability checks.
 */
class Gate
{
    /**
     * @var array<string, array> Maps ability => [roles]
     */
    protected static array $permissions = [];

    /**
     * @var array<string, array> Maps ability => [roles]
     */
    protected static array $denials = [];

    /**
     * @var array<string, callable> Maps ability => callback($user, ...$args): bool
     */
    protected static array $policies = [];

    /**
     * @var array<string, string> Maps ability => Policy class name
     */
    protected static array $policyClasses = [];

    /**
     * Allow a role to perform an ability.
     */
    public static function allow(string $ability, string $role): void
    {
        self::$permissions[$ability][] = $role;
        Chronicle::note("Author allowed '$ability' for '$role'");
    }

    /**
     * Deny a role from performing an ability.
     */
    public static function deny(string $ability, string $role): void
    {
        self::$denials[$ability][] = $role;
        Chronicle::interrupt("Author denied '$ability' for '$role'");
    }

    /**
     * Register a policy callback for an ability.
     *
     * @param string $ability
     * @param callable $callback function($user, ...$args): bool
     */
    public static function policy(string $ability, callable $callback): void
    {
        self::$policies[$ability] = $callback;
    }

    /**
     * Register a policy class for an ability.
     *
     * @param string $ability
     * @param string $policyClass Fully qualified class name implementing PolicyInterface
     */
    public static function policyClass(string $ability, string $policyClass): void
    {
        if (class_exists($policyClass) && in_array(PolicyInterface::class, class_implements($policyClass))) {
            self::$policyClasses[$ability] = $policyClass;
        }
    }

    /**
     * Check if a user can perform an ability, optionally with arguments.
     *
     * @param string $ability
     * @param mixed $user
     * @param mixed ...$args
     * @return bool
     */
    public static function can(string $ability, $user, ...$args): bool
    {
        // 1. Check policy callback
        if (isset(self::$policies[$ability])) {
            $result = (bool) call_user_func(self::$policies[$ability], $user, ...$args);
            Chronicle::note("Policy callback for '$ability' returned " . ($result ? 'true' : 'false'));
            return $result;
        }
        // 2. Check policy class
        if (isset(self::$policyClasses[$ability])) {
            $policyClass = self::$policyClasses[$ability];
            $policy = new $policyClass();
            $result = $policy->enact($user, ...$args);
            Chronicle::note("Policy class $policyClass for '$ability' returned " . ($result ? 'true' : 'false'));
            return $result;
        }
        // 3. Check role-based permissions/denials
        $userRoles = method_exists($user, 'roles') ? $user->roles() : [];
        foreach ($userRoles as $role) {
            if (in_array($role, self::$permissions[$ability] ?? [])) {
                Chronicle::note("Role '$role' allowed for '$ability'");
                return true;
            }
            if (in_array($role, self::$denials[$ability] ?? [])) {
                Chronicle::interrupt("Role '$role' denied for '$ability'");
                return false;
            }
        }
        Chronicle::warn("No permission found for '$ability'");
        return false;
    }
}
