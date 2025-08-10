<?php
use PHPUnit\Framework\TestCase;
use Mynorel\Api\ApiService;

class ApiServiceTest extends TestCase
{
    public function testUnauthorizedApiAccess()
    {
        $_SESSION = [];
        $response = ApiService::handle(['method' => 'GET', 'path' => '/resources']);
        $this->assertEquals('error', $response['status']);
    }
}
