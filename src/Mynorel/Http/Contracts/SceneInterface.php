<?php
namespace Mynorel\Http\Contracts;

use Mynorel\Http\Request;
use Mynorel\Http\Response;

interface SceneInterface
{
    public function __invoke(Request $request): Response;
}
