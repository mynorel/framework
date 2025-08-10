<?php
// tests/Plugin/MarketplaceServiceTest.php

use Mynorel\Plugin\Marketplace\MarketplaceService;

class MarketplaceServiceTest extends \PHPUnit\Framework\TestCase {
    public function testListPlugins() {
        $plugins = MarketplaceService::listPlugins();
        $this->assertIsArray($plugins);
        $this->assertNotEmpty($plugins);
    }
    public function testInstallPlugin() {
        $result = MarketplaceService::install('narrative-notes');
        $this->assertStringContainsString('installed', $result);
        $result2 = MarketplaceService::install('narrative-notes');
        $this->assertStringContainsString('already installed', $result2);
    }
    public function testInstallUnknownPlugin() {
        $result = MarketplaceService::install('unknown-plugin');
        $this->assertStringContainsString('not found', $result);
    }
}
