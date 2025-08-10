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

    /**
     * Wrap compiled content with layout sections (header/footer if present).
     */
    public function wrap(string $compiled, array $context = []): string
    {
        $sections = $this->sections();
        $output = '';
        if (isset($sections['header'])) {
            $output .= $sections['header'];
        }
        $output .= $compiled;
        if (isset($sections['footer'])) {
            $output .= $sections['footer'];
        }
        return $output;
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
