<?php
namespace Mynorel\Facades;

use Mynorel\Author\Author as AuthorCore;

/**
 * Author: Facade for permission checks in directives and templates.
 */
class Author
{
    public static function can(string $ability, $user): bool
    {
        return AuthorCore::can($ability)->as($user);
    }

    public static function role($user, string $role): bool
    {
        return method_exists($user, 'is') && $user->is($role);
    }
}
