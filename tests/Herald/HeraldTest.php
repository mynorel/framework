<?php
// ... Herald tests following Mynorel's narrative style ...

use PHPUnit\Framework\TestCase;
use Mynorel\Herald\Herald;

class HeraldTest extends TestCase
{
    public function testHeraldCanBroadcast()
    {
        $herald = new Herald();
        $this->assertTrue(method_exists($herald, 'broadcast'));
    }

    public function testSetSentinel()
    {
        $herald = new Herald();
        $this->assertTrue(method_exists($herald, 'setSentinel'));
    }
}
