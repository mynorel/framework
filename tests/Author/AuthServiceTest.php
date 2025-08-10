<?php
use PHPUnit\Framework\TestCase;
use Mynorel\Author\AuthService;

class AuthServiceTest extends TestCase
{
    public function testAttemptFailsWithWrongCredentials()
    {
        $_SESSION = [];
        $this->assertFalse(AuthService::attempt('wrong', 'wrong'));
    }

    public function testAttemptSucceedsWithCorrectCredentials()
    {
        $_SESSION = [];
        $this->assertTrue(AuthService::attempt('admin', 'password'));
    }
}
