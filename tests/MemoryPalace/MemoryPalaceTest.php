<?php
// ... MemoryPalace tests following Mynorel's narrative style ...

use PHPUnit\Framework\TestCase;
use Mynorel\MemoryPalace\MemoryPalace;

class MemoryPalaceTest extends TestCase
{
    public function testInscribeAndRecall()
    {
        MemoryPalace::clear();
        MemoryPalace::inscribe('hero', 'Arthur');
        $this->assertEquals('Arthur', MemoryPalace::recall('hero'));
    }

    public function testForgetMemory()
    {
        MemoryPalace::clear();
        MemoryPalace::inscribe('quest', 'Grail');
        MemoryPalace::forget('quest');
        $this->assertNull(MemoryPalace::recall('quest'));
    }
}
