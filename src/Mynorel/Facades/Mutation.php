<?php
namespace Mynorel\Facades;

use Mynorel\Testing\Mutation\MutationTest;

/**
 * Mutation: Facade for mutation testing.
 */
class Mutation
{
    public static function run($testSuite = 'all')
    {
        return MutationTest::runMutations($testSuite);
    }
}
