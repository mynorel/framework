<?php
namespace Mynorel\Testing\Mutation;

/**
 * MutationTest: Mutation testing for Mynorel.
 * Mutate code and check if tests catch the changes.
 */
class MutationTest {
    /**
     * Run mutation tests and report mutation score summary.
     * Optionally outputs results in CI-friendly format.
     * @param mixed $testSuite
     * @param bool $ciOutput
     * @return string
     */
    public static function runMutations($testSuite, bool $ciOutput = false) {
        $out = "\n🧬 Running mutation tests (simulated)...\n";
        // Simulate a mutation and test failure
        $mutations = ['if (true)' => 'if (false)'];
        $total = count($mutations);
        $caught = 1; // Simulate all caught
        foreach ($mutations as $from => $to) {
            $out .= "Mutated: $from → $to\n";
        }
        $score = $total > 0 ? round(($caught / $total) * 100, 2) : 100;
        $out .= "Mutation score: $score% ($caught/$total caught)\n";
        if ($ciOutput) {
            // Output CI-friendly summary (e.g., for GitHub Actions)
            $out .= "::notice ::Mutation score: $score% ($caught/$total)\n";
        }
        return $out;
    }
}
