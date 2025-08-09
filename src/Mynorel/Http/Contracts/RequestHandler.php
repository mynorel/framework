<?php
namespace Mynorel\Http\Contracts;

use Mynorel\Http\Request;
use Mynorel\Http\Response;

interface RequestHandler
{
    public function handle(Request $request): Response;
}
