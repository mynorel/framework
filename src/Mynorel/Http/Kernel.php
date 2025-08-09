<?php
namespace Mynorel\Http;

class Kernel
{
    /**
     * Handle the HTTP request lifecycle.
     */
    public static function handle(): void
    {
        $request = new Request();
        $response = Dispatcher::dispatch($request);
        $response->send();
    }
}
