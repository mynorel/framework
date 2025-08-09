<?php

use PHPUnit\Framework\TestCase;
use Mynorel\Extensions\ExtensionManager;
use Mynorel\Extensions\ExtensionServiceProvider;

// ...existing code...

require_once __DIR__ . '/TestExtensionForIntegration.php';

class ExtensionIntegrationTest extends TestCase
{
    public function testExtensionAutoDiscoveryAndBoot()
    {
        $configPath = __DIR__ . '/../../config/extensions.php';
        $original = file_get_contents($configPath);
        // Write the test extension class name to config
    file_put_contents($configPath, "<?php\nreturn ['TestExtensionForIntegration'];\n");
        // Run provider
        \Mynorel\Extensions\ExtensionServiceProvider::registerAndBootFromConfig();
        $this->assertTrue(TestExtensionForIntegration::$booted);
        // Restore config
        file_put_contents($configPath, $original);
    }
}
