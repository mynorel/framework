<?php
namespace Mynorel\Dev\Doctor;

/**
 * DoctorCLI: Diagnose and fix common Mynorel issues from the command line.
 */
class DoctorCLI {
    public static function run() {
        echo "\n🌱 Mynorel Doctor: A narrative health check begins...\n";
        $issues = 0;

        // PHP version check
        $phpVersion = phpversion();
        if (version_compare($phpVersion, '8.1.0', '>=')) {
            echo "✔ PHP version ($phpVersion) is compatible.\n";
        } else {
            echo "✗ PHP version ($phpVersion) is too old. Upgrade to 8.1+.\n";
            $issues++;
        }

        // Composer check
        if (file_exists(getcwd() . '/composer.json')) {
            echo "✔ composer.json found.\n";
        } else {
            echo "✗ composer.json not found.\n";
            $issues++;
        }

        // Config check
        if (is_dir(getcwd() . '/config')) {
            echo "✔ config/ directory found.\n";
        } else {
            echo "✗ config/ directory missing.\n";
            $issues++;
        }

        // Autoload check
        if (file_exists(getcwd() . '/vendor/autoload.php')) {
            echo "✔ Composer autoload found.\n";
        } else {
            echo "✗ Composer autoload missing. Run 'composer install'.\n";
            $issues++;
        }

        // PHPUnit check
        if (file_exists(getcwd() . '/vendor/bin/phpunit')) {
            echo "✔ PHPUnit is installed.\n";
        } else {
            echo "✗ PHPUnit is not installed. Run 'composer require --dev phpunit/phpunit'.\n";
            $issues++;
        }

        // Narrative finale
        if ($issues === 0) {
            echo "\n🌱 All is well in your narrative world!\n";
        } else {
            echo "\n✗ Mynorel Doctor found $issues issue(s). See above for details.\n";
        }
    }
}
