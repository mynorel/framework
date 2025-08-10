<?php
use PHPUnit\Framework\TestCase;
use Mynorel\Media\MediaService;

class MediaServiceTest extends TestCase
{
    public function testUploadThrowsForGuest()
    {
        $_SESSION = [];
        $this->expectException(Exception::class);
        MediaService::upload(['name' => 'file.txt', 'tmp_name' => '/tmp/file.txt']);
    }
}
