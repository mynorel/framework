<?php
use PHPUnit\Framework\TestCase;
use Mynorel\Resource\ResourceService;

class ResourceServiceTest extends TestCase
{
    public function testListThrowsForGuest()
    {
        $_SESSION = [];
        $this->expectException(Exception::class);
        ResourceService::list();
    }
}
