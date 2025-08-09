<?php
use PHPUnit\Framework\TestCase;
use Mynorel\Session\Session;
use Mynorel\Session\Flash;

class FlashTest extends TestCase
{
    protected function setUp(): void
    {
        Session::end();
    }

    public function testSetGetClear()
    {
        Flash::set('success', 'Done!');
        $this->assertEquals('Done!', Flash::get('success'));
        $this->assertNull(Flash::get('success'));
        Flash::set('info', 'Hello');
        Flash::clear();
        $this->assertNull(Flash::get('info'));
    }

    public function testPeekAndHas()
    {
        Flash::set('alert', 'Danger!');
        $this->assertEquals('Danger!', Flash::peek('alert'));
        $this->assertTrue(Flash::has('alert'));
        Flash::get('alert');
        $this->assertFalse(Flash::has('alert'));
    }
}
