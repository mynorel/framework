<?php
namespace Mynorel\Prelude\Contracts;
/**
 * RitualInterface: Contract for handler classes (actions after guards).
 */
interface RitualInterface
{
    /**
     * Execute the ritual logic.
     * @param mixed $context
     * @return mixed
     */
    public function perform($context = null);
}
