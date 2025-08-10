<?php
// tests/Academy/AcademyServiceTest.php

use Mynorel\Academy\AcademyService;

class AcademyServiceTest extends \PHPUnit\Framework\TestCase {
    public function testStartTutorial() {
        $out = AcademyService::startTutorial();
        $this->assertStringContainsString('Welcome to Mynorel Academy', $out);
        $this->assertStringContainsString('onboarding journey', $out);
        $this->assertStringContainsString('legendary narratives', $out);
    }
}
