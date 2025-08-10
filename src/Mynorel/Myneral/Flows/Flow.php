<?php
namespace Mynorel\Myneral\Flows;

/**
 * Flow: Defines a sequence of directives for a narrative flow.
 */
class Flow
{
    protected array $sequence = [];

    public function __construct(array $sequence)
    {
        $this->sequence = $sequence;
    }

    /**
     * Apply the flow to compiled content (stub: returns content unchanged).
     */
    public function apply(string $compiled, array $context = []): string
    {
        // Extend this to actually process flow steps if needed
        return $compiled;
    }

    public function sequence(): array
    {
        return $this->sequence;
    }
}
