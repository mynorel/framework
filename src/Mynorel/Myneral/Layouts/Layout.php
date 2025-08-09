<?php
namespace Mynorel\Myneral\Layouts;

/**
 * Layout: Represents a composable layout template.
 */
class Layout
{
    protected string $name;
    protected array $sections;

    public function __construct(string $name, array $sections = [])
    {
        $this->name = $name;
        $this->sections = $sections;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function sections(): array
    {
        return $this->sections;
    }
}
