<?php
namespace Mynorel\Session;

/**
 * Session: Narrative session layer for Mynorel.
 * Stores fragments of the user's journey (state, flash, identity) across requests.
 */
use ArrayAccess;

class Session implements ArrayAccess
{
    /** @var array<string, array<int, callable>> */
    protected static array $hooks = [
        'start' => [],
        'end' => [],
        'inscribe' => [],
        'recall' => [],
        'forget' => [],
    ];
    // Custom driver support (not used in this implementation, but reserved for future use)
    protected static $driver = null;
    /**
     * Start the session if not already started.
     */
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            self::trigger('start');
        }
    }

    /**
     * Set a value in the session (inscribe a memory).
     */
    public static function inscribe(string $key, $value): void
    {
        self::start();
        $ref =& self::namespaceRef($key);
        $ref = $value;
        self::trigger('inscribe', $key, $value);
    }

    /**
     * Get a value from the session (recall a memory).
     */
    public static function recall(string $key, $default = null)
    {
        self::start();
        $exists = true;
        $ref =& $_SESSION;
        $parts = explode('.', $key);
        foreach ($parts as $part) {
            if (!array_key_exists($part, $ref)) {
                $exists = false;
                break;
            }
            $ref =& $ref[$part];
        }
        $result = $exists ? $ref : $default;
        if (!$exists) {
            $result = null;
        }
        self::trigger('recall', $key, $result);
        return $result;
    }

    /**
     * Remove a value from the session (forget a memory).
     */
    public static function forget(string $key): void
    {
        self::start();
        $parts = explode('.', $key);
        $ref =& $_SESSION;
        while (count($parts) > 1) {
            $part = array_shift($parts);
            if (!isset($ref[$part]) || !is_array($ref[$part])) return;
            $ref =& $ref[$part];
        }
        unset($ref[array_shift($parts)]);
        self::trigger('forget', $key);
    }

    /**
     * Destroy the session (end the journey).
     */
    public static function end(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            self::trigger('end');
            session_unset();
            session_destroy();
        }
    }

    /**
     * Flash a value to the session (one-time memory).
     */
    public static function flash(string $key, $value): void
    {
        self::inscribe('__flash__.' . $key, $value);
    }

    /**
     * Retrieve and remove a flashed value.
     */
    public static function recallFlash(string $key, $default = null)
    {
        $flashKey = '__flash__.' . $key;
        $value = self::recall($flashKey, $default);
        self::forget($flashKey);
        return $value;
    }

    /**
     * Regenerate the session ID (for security, e.g., after login).
     */
    public static function regenerateId(bool $deleteOldSession = true): void
    {
        self::start();
        session_regenerate_id($deleteOldSession);
    }

    /**
     * Set a custom session driver (closure: function(&$session, $action, ...$args)).
     */
    public static function setDriver(callable $driver): void
    {
        self::$driver = $driver;
    }

    /**
     * Get a reference to a namespaced session key (dot notation).
     */
    protected static function &namespaceRef(string $key)
    {
        $parts = explode('.', $key);
        $ref =& $_SESSION;
        foreach ($parts as $part) {
            if (!isset($ref[$part])) {
                $ref[$part] = [];
            }
            $ref =& $ref[$part];
        }
        return $ref;
    }

    /**
     * CSRF token generation and validation.
     */
    public static function csrfToken(): string
    {
        $token = self::recall('__csrf_token');
        if (!$token) {
            $token = bin2hex(random_bytes(32));
            self::inscribe('__csrf_token', $token);
        }
        return $token;
    }
    public static function validateCsrfToken(string $token): bool
    {
        return hash_equals(self::csrfToken(), $token);
    }

    /**
     * Remember-me (persistent login) support.
     */
    public static function remember(string $key, $value, int $ttl = 1209600): void
    {
        setcookie($key, $value, [
            'expires' => time() + $ttl,
            'path' => '/',
            'httponly' => true,
            'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
            'samesite' => 'Lax',
        ]);
    }
    public static function recallRemember(string $key, $default = null)
    {
        return $_COOKIE[$key] ?? $default;
    }
    public static function forgetRemember(string $key): void
    {
        setcookie($key, '', time() - 3600, '/');
    }

    /**
     * Session timeout helpers.
     */
    public static function setTimeout(int $seconds): void
    {
        self::inscribe('__timeout', time() + $seconds);
    }
    public static function isExpired(): bool
    {
        $expires = self::recall('__timeout');
        return $expires && time() > $expires;
    }

    /**
     * Inspect all session data.
     */
    public static function all(): array
    {
        self::start();
        return $_SESSION;
    }
    public static function keys(): array
    {
        self::start();
        return array_keys($_SESSION);
    }

    /**
     * Event hooks (on start, end, inscribe, recall, forget).
     */
    public static function on(string $event, callable $callback): void
    {
        if (isset(self::$hooks[$event])) {
            self::$hooks[$event][] = $callback;
        }
    }
    protected static function trigger(string $event, ...$args): void
    {
        if (isset(self::$hooks[$event])) {
            foreach (self::$hooks[$event] as $cb) {
                $cb(...$args);
            }
        }
    }

    /**
     * ArrayAccess implementation.
     */
    public function offsetExists(mixed $offset): bool { return isset($_SESSION[$offset]); }
    public function offsetGet(mixed $offset): mixed { return $_SESSION[$offset] ?? null; }
    public function offsetSet(mixed $offset, mixed $value): void { $_SESSION[$offset] = $value; }
    public function offsetUnset(mixed $offset): void { unset($_SESSION[$offset]); }
}
