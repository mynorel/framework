<?php
use PHPUnit\Framework\TestCase;
use Mynorel\Session\Session;
use Mynorel\Http\Csrf;

class CsrfTest extends TestCase
{
    protected function setUp(): void
    {
        Session::end();
    }

    public function testTokenGenerationAndValidation()
    {
        $token = Csrf::token();
        $this->assertNotEmpty($token);
        $this->assertTrue(Csrf::validate($token));
        $this->assertFalse(Csrf::validate('invalid-token'));
    }

    public function testFieldOutput()
    {
        $field = Csrf::field();
        $this->assertStringContainsString('csrf_token', $field);
        $this->assertStringContainsString('input', $field);
    }
}
