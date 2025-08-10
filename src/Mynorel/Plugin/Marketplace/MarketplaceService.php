<?php
namespace Mynorel\Plugin\Marketplace;

/**
 * MarketplaceService: Discover, install, and manage Mynorel plugins.
 */

class MarketplaceService {
    /**
     * Available plugins: key => [desc, version, dependencies, signature]
     */
    protected static array $available = [
        'narrative-notes' => [
            'desc' => 'Narrative Notes: Add poetic notes to your app.',
            'version' => '1.0.0',
            'dependencies' => [],
            'signature' => 'abc123',
        ],
        'chronicle-export' => [
            'desc' => 'Chronicle Export: Export logs to Markdown.',
            'version' => '1.1.0',
            'dependencies' => [],
            'signature' => 'def456',
        ],
        'theme-noir' => [
            'desc' => 'Theme Noir: A dark, narrative theme.',
            'version' => '2.0.0',
            'dependencies' => ['narrative-notes'],
            'signature' => 'ghi789',
        ],
    ];
    protected static array $installed = [];

    /**
     * List plugins with version and status.
     */
    public static function listPlugins() {
        $plugins = [];
        foreach (self::$available as $key => $meta) {
            $status = in_array($key, self::$installed) ? ' (installed)' : '';
            $plugins[] = "$key v{$meta['version']}: {$meta['desc']}$status";
        }
        return $plugins;
    }

    /**
     * Install a plugin with dependency and signature validation.
     */
    public static function install($name) {
        if (!isset(self::$available[$name])) {
            return "✗ Plugin '$name' not found in the marketplace.";
        }
        if (in_array($name, self::$installed)) {
            return "✔ Plugin '$name' is already installed.";
        }
        // Validate dependencies
        foreach (self::$available[$name]['dependencies'] as $dep) {
            if (!in_array($dep, self::$installed)) {
                return "✗ Dependency '$dep' required for '$name'. Install it first.";
            }
        }
        // Validate signature (stub)
        if (!self::validateSignature($name, self::$available[$name]['signature'])) {
            return "✗ Plugin signature invalid for '$name'.";
        }
        // Simulate remote fetch (stub)
        // $remote = self::fetchRemote($name);
        self::$installed[] = $name;
        return "✔ Plugin '$name' v" . self::$available[$name]['version'] . " installed: " . self::$available[$name]['desc'];
    }

    /**
     * Validate plugin signature (stub for real cryptographic check).
     */
    protected static function validateSignature($name, $signature): bool
    {
        // In real implementation, verify cryptographic signature
        return is_string($signature) && strlen($signature) > 0;
    }

    /**
     * Fetch plugin metadata from remote repository (stub).
     */
    public static function fetchRemote($name) {
        // In real implementation, fetch from trusted registry
        return self::$available[$name] ?? null;
    }
}
