<?php
namespace Mynorel\Author\Contracts;

/**
 * Authenticatable: Contract for user authentication in Mynorel.
 * Implementing classes must provide identity, password, and authentication logic.
 */
interface Authenticatable
{
    /**
     * Get the unique identifier for the user (e.g., id, username).
     */
    public function getAuthIdentifier(): string;

    /**
     * Get the hashed password for the user.
     */
    public function getAuthPassword(): string;

    /**
     * Validate the given password against the stored hash.
     */
    public function validatePassword(string $password): bool;
}
