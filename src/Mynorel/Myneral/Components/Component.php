<?php
namespace Mynorel\Myneral\Components;

/**
 * Base class for all Myneral components.
 */
abstract class Component
{
    /**
     * Render the component with given parameters.
     * @param array $params
     * @return string
     */
    abstract public function render(array $params = []): string;
}
