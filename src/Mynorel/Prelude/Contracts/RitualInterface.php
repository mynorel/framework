<?php
namespace Mynorel\Rituals;

/**
 * RitualInterface: Contract for handlers (rituals) in Mynorel.
 */
interface RitualInterface
{
    /**
     * Execute the ritual (handler logic).
     * @param mixed $context
     * @return mixed
     */
    public function handle($context);
}
