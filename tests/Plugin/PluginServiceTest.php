<?php
use PHPUnit\Framework\TestCase;
use Mynorel\Plugin\PluginService;

class PluginServiceTest extends TestCase
{
    public function testActivateThrowsForGuest()
    {
        $_SESSION = [];
        $this->expectException(Exception::class);
        PluginService::activate('plugin');
    }
}
