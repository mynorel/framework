<?php
namespace Mynorel\Myneral\Directives;

/**
 * BaseDirective: Abstract base for all Myneral directives.
 */
abstract class BaseDirective
{
    /**
     * The inner content of a block directive (if any).
     * @var string|null
     */
    protected ?string $content = null;

    /**
     * Set the inner content for block directives.
     * @param string $content
     * @return void
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Compile the directive to PHP or output.
     * @param mixed $args
     * @return string
     */
    abstract public function compile($args, array $context = []): string;
}
