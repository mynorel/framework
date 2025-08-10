<?php
// tests/Herald/HeraldDashboardTest.php

use Mynorel\Herald\Dashboard\HeraldDashboard;

class HeraldDashboardTest extends \PHPUnit\Framework\TestCase {
    public function testRender() {
        $out = HeraldDashboard::render();
        $this->assertStringContainsString('Herald Dashboard', $out);
        $this->assertStringContainsString('Channel:', $out);
    }
}
