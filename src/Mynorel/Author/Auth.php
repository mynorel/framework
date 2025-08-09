<?php
namespace Mynorel\Author;

use Mynorel\Author\Contracts\Authenticatable;

/**
 * Auth: Narrative authentication layer for Mynorel.
 * Handles login, logout, and user identity in a story-driven way.
 */
class Auth
{
    protected static ?Authenticatable $user = null;
    protected static bool $restored = false;

    /**
     * Attempt to authenticate a user with identifier and password.
     * Returns true on success, false on failure.
     */
    public static function attempt(callable $userResolver, string $identifier, string $password): bool
    {
        $user = $userResolver($identifier);
        if ($user instanceof Authenticatable && $user->validatePassword($password)) {
            self::$user = $user;
            \Mynorel\Session\Session::inscribe('auth_id', $user->getAuthIdentifier());
            return true;
        }
        return false;
    }

    /**
     * Get the currently authenticated user, if any.
     */
    public static function user(?callable $userResolver = null): ?Authenticatable
    {
        // Restore from session if not already restored
        if (!self::$user && !self::$restored && $userResolver) {
            $authId = \Mynorel\Session\Session::recall('auth_id');
            if ($authId) {
                $user = $userResolver($authId);
                if ($user instanceof Authenticatable) {
                    self::$user = $user;
                }
            }
            self::$restored = true;
        }
        return self::$user;
    }

    /**
     * Log out the current user.
     */
    public static function logout(): void
    {
        self::$user = null;
        \Mynorel\Session\Session::forget('auth_id');
    }

    /**
     * Check if a user is authenticated.
     */
    public static function check(): bool
    {
        return self::$user !== null;
    }
}
