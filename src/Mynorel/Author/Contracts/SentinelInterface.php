<?php
namespace Mynorel\Sentinels;

/**
 * SentinelInterface: Contract for guards (sentinels) in Mynorel.
 */
interface SentinelInterface
{
    /**
     * Check if the sentinel allows passage.
     * @param mixed $context
     * @return bool
     */
    public function check($context): bool;
}
