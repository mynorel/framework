<?php
namespace Mynorel\Prelude\Contracts;
/**
 * SentinelInterface: Contract for guard classes (preconditions).
 */
interface SentinelInterface
{
    /**
     * Check if the guard passes for the given context.
     * @param mixed $context
     * @return bool
     */
    public function check($context = null): bool;
}
