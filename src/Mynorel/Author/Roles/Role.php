<?php
namespace Mynorel\Author\Roles;

/**
 * Role: Value object representing a character/role in the narrative.
 */
class Role
{
    /**
     * @var string
     */
    protected string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the role's name.
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Check if this role matches a given name.
     * @param string $role
     * @return bool
     */
    public function is(string $role): bool
    {
        return $this->name === $role;
    }
}
