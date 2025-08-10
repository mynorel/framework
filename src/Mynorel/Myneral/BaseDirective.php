<?php
namespace Mynorel\Myneral\Directives;

abstract class BaseDirective
{
    /**
     * Compile the directive to PHP output.
     * @param array $args
     * @param array $context
     * @return string
     */
    abstract public function compile($args, array $context = []): string;
}
