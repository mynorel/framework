<?php
namespace Mynorel\Services\Contracts;

interface Authorizable
{
    public function can(string $action, string $role): bool;
}
