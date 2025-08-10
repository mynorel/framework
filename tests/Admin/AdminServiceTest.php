<?php
use PHPUnit\Framework\TestCase;
use Mynorel\Admin\AdminService;

class AdminServiceTest extends TestCase
{
    public function testCanAccessReturnsFalseForGuest()
    {
        $_SESSION = [];
        $this->assertFalse(AdminService::canAccess());
    }

    public function testCanAccessReturnsTrueForAdmin()
    {
        $_SESSION['author_id'] = 1;
        // Simulate admin user in AuthService stub
        $this->assertTrue(AdminService::canAccess());
    }

    public function testRegisterResourceThrowsForGuest()
    {
        $this->expectException(Exception::class);
        $_SESSION = [];
        AdminService::registerResource('TestResource');
    }
}
