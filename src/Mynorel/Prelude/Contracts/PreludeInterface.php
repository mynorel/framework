<?php
namespace Mynorel\Prelude\Contracts;
/**
 * PreludeInterface: Contract for all Prelude (middleware) classes.
 */
interface PreludeInterface
{
    /**
     * Handle the context and perform pre-processing.
     * @param mixed $context
     * @return void
     */
    public function handle($context = null): void;
}
