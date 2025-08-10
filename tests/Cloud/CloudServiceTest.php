<?php
use PHPUnit\Framework\TestCase;
use Mynorel\Cloud\CloudService;

class CloudServiceTest extends TestCase
{
    public function testDeployThrowsForGuest()
    {
        $_SESSION = [];
        $this->expectException(Exception::class);
        CloudService::deploy('app', 'provider');
    }
}
