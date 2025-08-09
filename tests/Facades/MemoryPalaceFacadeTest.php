<?php
// ... MemoryPalace Facade tests following Mynorel's narrative style ...

use PHPUnit\Framework\TestCase;
use Mynorel\Facades\MemoryPalace;

class MemoryPalaceFacadeTest extends TestCase
{
    public function testFacadeInscribeRecall()
    {
        \Mynorel\Scriptorium\Scriptorium::clear();
        \Mynorel\Scriptorium\Scriptorium::singleton('memorypalace', function() {
            return '\\Mynorel\\MemoryPalace\\MemoryPalace';
        });
        MemoryPalace::clear();
        MemoryPalace::inscribe('villain', 'Morgana');
        $this->assertEquals('Morgana', MemoryPalace::recall('villain'));
    }
}
