<?php
use PHPUnit\Framework\TestCase;
use Mynorel\Session\Session;

class SessionTest extends TestCase
{
    protected function setUp(): void
    {
        Session::end();
    }

    public function testInscribeRecallForget()
    {
        Session::inscribe('hero', 'Arthur');
        $this->assertEquals('Arthur', Session::recall('hero'));
        Session::forget('hero');
        $this->assertNull(Session::recall('hero'));
    }

    public function testNamespaceDotNotation()
    {
        Session::inscribe('quest.item', 'Grail');
        $this->assertEquals('Grail', Session::recall('quest.item'));
        Session::forget('quest.item');
        $this->assertNull(Session::recall('quest.item'));
    }

    public function testFlash()
    {
        Session::flash('notice', 'Welcome!');
        $this->assertEquals('Welcome!', Session::recallFlash('notice'));
        $this->assertNull(Session::recallFlash('notice'));
    }

    public function testRegenerateId()
    {
        Session::start();
        $oldId = session_id();
        Session::regenerateId();
        $this->assertNotEquals($oldId, session_id());
    }

    public function testTimeout()
    {
        Session::setTimeout(1);
        sleep(2);
        $this->assertTrue(Session::isExpired());
    }

    public function testArrayAccess()
    {
        $session = new Session();
        $session['foo'] = 'bar';
        $this->assertEquals('bar', $session['foo']);
        unset($session['foo']);
        $this->assertNull($session['foo']);
    }
}
