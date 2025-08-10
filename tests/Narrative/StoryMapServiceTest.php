<?php
// tests/Narrative/StoryMapServiceTest.php

use Mynorel\Narrative\StoryMap\StoryMapService;

class StoryMapServiceTest extends \PHPUnit\Framework\TestCase {
    public function testExportImport() {
        $json = StoryMapService::export();
        $this->assertJson($json);
        $ok = StoryMapService::import($json);
        $this->assertTrue($ok);
    }
    public function testSummary() {
        $summary = StoryMapService::summary();
        $this->assertStringContainsString('Story Map', $summary);
        $this->assertStringContainsString('Chapter', $summary);
    }
}
