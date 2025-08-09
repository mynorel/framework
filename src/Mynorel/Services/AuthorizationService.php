<?php
namespace Mynorel\Services;

class AuthorizationService
{
    protected array $permissions = [];

    public function allow(string $action, string $role): void
    {
        $this->permissions[$role][] = $action;
    }

    public function deny(string $action, string $role): void
    {
        $this->permissions[$role] = array_diff(
            $this->permissions[$role] ?? [],
            [$action]
        );
    }

    public function can(string $action, string $role): bool
    {
        return in_array($action, $this->permissions[$role] ?? []);
    }
}
