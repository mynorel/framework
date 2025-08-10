<?php
use PHPUnit\Framework\TestCase;
use Mynorel\Billing\BillingService;

class BillingServiceTest extends TestCase
{
    public function testSubscribeThrowsForGuest()
    {
        $_SESSION = [];
        $this->expectException(Exception::class);
        BillingService::subscribe('user', 'plan');
    }
}
