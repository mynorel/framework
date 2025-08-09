<?php

use PHPUnit\Framework\TestCase;
use Mynorel\Prelude\Prelude;

class PreludeTest extends TestCase
{
    public function testSequenceRunsWithoutError()
    {
        // Compose a dummy pipeline
        Prelude::compose('test', []);
        // Should not throw or error
        $this->assertNull(Prelude::sequence('test'));
    }
}
