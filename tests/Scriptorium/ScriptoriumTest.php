<?php
// ... Scriptorium tests following Mynorel's narrative style ...

use PHPUnit\Framework\TestCase;
use Mynorel\Scriptorium\Scriptorium;

class ScriptoriumTest extends TestCase
{
    public function testBindAndMake()
    {
        Scriptorium::clear();
        Scriptorium::bind('scribe', function() { return 'ink'; });
        $this->assertEquals('ink', Scriptorium::make('scribe'));
    }

    public function testHasBinding()
    {
        Scriptorium::clear();
        Scriptorium::bind('scroll', fn() => 'parchment');
        $this->assertTrue(Scriptorium::has('scroll'));
    }
}
