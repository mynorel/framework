<?php
namespace Mynorel\Author;

use Mynorel\Config\Config;

/**
 * AuthService: Handles authentication, registration, and session logic for Authors.
 * All logic is narrative-driven and fully integrated with Mynorel's config and services.
 */
class AuthService
{
    /**
     * Attempt to authenticate an author by credentials.
     */
    public static function attempt(string $username, string $password): bool
    {
        // Example: Replace with real user provider logic
        $authors = self::getAuthors();
        foreach ($authors as $author) {
            if ($author['username'] === $username && password_verify($password, $author['password'])) {
                $_SESSION['author_id'] = $author['id'];
                return true;
            }
        }
        return false;
    }

    /**
     * Register a new author.
     */
    public static function register(string $username, string $password, array $attributes = []): bool
    {
        // Example: Replace with real persistence logic
        // This is a stub for demonstration
        return false;
    }

    /**
     * Get the currently authenticated author, or null.
     */
    public static function user(): ?array
    {
        if (!isset($_SESSION['author_id'])) return null;
        $authors = self::getAuthors();
        foreach ($authors as $author) {
            if ($author['id'] === $_SESSION['author_id']) {
                return $author;
            }
        }
        return null;
    }

    /**
     * Log out the current author.
     */
    public static function logout(): void
    {
        unset($_SESSION['author_id']);
    }

    /**
     * Check if the current author has a given role.
     */
    public static function hasRole(string $role): bool
    {
        $user = self::user();
        return $user && in_array($role, $user['roles'] ?? []);
    }

    /**
     * Example: Get all authors (stub, replace with real data source).
     */
    protected static function getAuthors(): array
    {
        // Example stub data
        return [
            [
                'id' => 1,
                'username' => 'admin',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'roles' => ['admin'],
            ],
        ];
    }
}
