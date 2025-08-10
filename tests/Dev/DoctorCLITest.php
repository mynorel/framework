<?php
// tests/Dev/DoctorCLITest.php

use Mynorel\Dev\Doctor\DoctorCLI;

class DoctorCLITest extends \PHPUnit\Framework\TestCase {
    public function testRun() {
        $this->expectOutputRegex('/Mynorel Doctor: A narrative health check begins/');
        DoctorCLI::run();
    }
}
