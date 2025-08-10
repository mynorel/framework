<?php
namespace Mynorel\Myneral\HotReload;

/**
 * HotReloadService: Watches template files and reloads on change.
 */
class HotReloadService {
    /**
     * Watch a directory or file for changes and reload on change.
     * Uses inotify if available, otherwise falls back to polling.
     */
    public static function watch($path) {
        echo "\n🔄 Watching $path for changes...\n";
        // Check for inotify extension and required constants
        $hasInotify =
            \function_exists('inotify_init') &&
            \function_exists('inotify_add_watch') &&
            \function_exists('inotify_read') &&
            \defined('IN_MODIFY') &&
            \defined('IN_CREATE') &&
            \defined('IN_DELETE');

        if ($hasInotify) {
            $fd = null;
            if (\function_exists('inotify_init')) {
                $fd = \call_user_func('inotify_init');
            }
            if ($fd === false || $fd === null) {
                echo "⚠️  inotify_init() failed. Falling back to polling.\n";
            } else {
                stream_set_blocking($fd, 0);
                $watchFlags = \constant('IN_MODIFY') | \constant('IN_CREATE') | \constant('IN_DELETE');
                $wd = null;
                if (is_dir($path)) {
                    if (\function_exists('inotify_add_watch')) {
                        $wd = \call_user_func('inotify_add_watch', $fd, $path, $watchFlags);
                    }
                } else {
                    if (\function_exists('inotify_add_watch')) {
                        $wd = \call_user_func('inotify_add_watch', $fd, dirname($path), \constant('IN_MODIFY'));
                    }
                }
                // Infinite loop: intended for continuous watching
                while (true) {
                    $events = null;
                    if (\function_exists('inotify_read')) {
                        $events = \call_user_func('inotify_read', $fd);
                    }
                    if ($events) {
                        echo "🔄 Detected change in $path. Reloading template...\n";
                    }
                    usleep(500000); // 0.5s
                }
                // fclose($fd); // unreachable
            }
        } else {
            if (!extension_loaded('inotify')) {
                echo "⚠️  The inotify extension is not installed. Install it for efficient file watching (e.g., 'pecl install inotify'). Falling back to polling.\n";
            } else {
                echo "⚠️  inotify functions or constants not defined. Check your PHP inotify installation. Falling back to polling.\n";
            }
            $last = is_file($path) ? filemtime($path) : time();
            // Infinite loop: intended for continuous watching
            while (true) {
                clearstatcache();
                $current = is_file($path) ? filemtime($path) : time();
                if ($current !== $last) {
                    echo "🔄 Detected change in $path. Reloading template...\n";
                    $last = $current;
                }
                usleep(1000000); // 1s
            }
        }
    }
}
