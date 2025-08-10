<?php
namespace Mynorel\Myneral\Flows;

class TestFlow extends Flow
{
    public function __construct()
    {
        parent::__construct(['note', 'show']);
    }

    public function apply(string $compiled, array $context = []): string
    {
        // Example: prepend a flow banner
        return '<div class="flow-banner">Test Flow Active</div>' . $compiled;
    }
}
