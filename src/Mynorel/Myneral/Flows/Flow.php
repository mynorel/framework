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

    public function sequence(): array
    {
        return $this->sequence;
    }
}
