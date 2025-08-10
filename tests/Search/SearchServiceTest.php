<?php
use PHPUnit\Framework\TestCase;
use Mynorel\Search\SearchService;

class SearchServiceTest extends TestCase
{
    public function testSearchThrowsForGuest()
    {
        $_SESSION = [];
        $this->expectException(Exception::class);
        SearchService::search('query');
    }
}
