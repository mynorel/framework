<?php
namespace Mynorel\Continuity;

/**
 * ContinuityChecker: Checks for plot holes (inconsistencies) before scenes/actions.
 */
class ContinuityChecker
{
    protected array $rules = [];

    /**
     * Add a continuity rule (closure returns true if valid).
     */
    public function addRule(callable $rule): void
    {
        $this->rules[] = $rule;
    }

    /**
     * Run all continuity checks on the given context.
     */
    public function check($context): array
    {
        $errors = [];
        foreach ($this->rules as $rule) {
            $result = $rule($context);
            if ($result !== true) {
                $errors[] = $result;
            }
        }
        return $errors;
    }
}
