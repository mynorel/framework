<?php
use PHPUnit\Framework\TestCase;
use Mynorel\Notification\NotificationService;

class NotificationServiceTest extends TestCase
{
    public function testSendThrowsForGuest()
    {
        $_SESSION = [];
        $this->expectException(Exception::class);
        NotificationService::send('user', 'message');
    }
}
