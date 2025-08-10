<?php
// tests/Testing/MutationTestTest.php

use Mynorel\Testing\Mutation\MutationTest;

class MutationTestTest extends \PHPUnit\Framework\TestCase {
    public function testRunMutations() {
        $out = MutationTest::runMutations('all');
        $this->assertStringContainsString('Running mutation tests', $out);
        $this->assertStringContainsString('Mutated:', $out);
        $this->assertStringContainsString('Mutation caught by tests', $out);
    }
}
