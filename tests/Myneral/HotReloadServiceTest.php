<?php
// tests/Myneral/HotReloadServiceTest.php

use Mynorel\Myneral\HotReload\HotReloadService;

class HotReloadServiceTest extends \PHPUnit\Framework\TestCase {
    public function testWatch() {
        $this->expectOutputRegex('/Watching .* for changes/');
        HotReloadService::watch('src/Mynorel/Myneral/Layouts');
    }
}
