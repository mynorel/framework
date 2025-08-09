<?php
namespace Mynorel\Http;

use Mynorel\Session\Session;

/**
 * Csrf: CSRF token helpers for Mynorel HTTP layer.
 */
class Csrf
{
    /**
     * Get the current CSRF token (generates if missing).
     */
    public static function token(): string
    {
        return Session::csrfToken();
    }

    /**
     * Validate a CSRF token (from request input).
     */
    public static function validate(?string $token): bool
    {
        return $token && Session::validateCsrfToken($token);
    }

    /**
     * Add CSRF token to a form as a hidden input (for templates).
     */
    public static function field(string $name = 'csrf_token'): string
    {
        $token = self::token();
        return '<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($token) . '">';
    }
}
