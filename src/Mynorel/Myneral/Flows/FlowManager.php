<?php
namespace Mynorel\Myneral\Flows;

use Mynorel\Myneral\Myneral;

class FlowManager
{
    protected static array $flows = [];

    public static function register(string $name, Flow $flow): void
    {
        self::$flows[$name] = $flow;
    }

    public static function get(string $name): ?Flow
    {
        return self::$flows[$name] ?? null;
    }

    /**
     * Validate a flow: check that all directives in the flow are registered in Myneral.
     * @param string $name
     * @return array List of missing directives (empty if valid)
     */
    public static function validate(string $name): array
    {
        $flow = self::get($name);
        if (!$flow) {
            if (class_exists('Mynorel\\Facades\\Chronicle')) {
                \Mynorel\Facades\Chronicle::warn("Flow '$name' not found.");
            }
            return ["Flow '$name' not found."];
        }
        $missing = [];
        $registered = method_exists(Myneral::class, 'getDirectives') ? Myneral::getDirectives() : [];
        foreach ($flow->sequence() as $directive) {
            if (!isset($registered[$directive])) {
                $missing[] = $directive;
                if (class_exists('Mynorel\\Facades\\Chronicle')) {
                    \Mynorel\Facades\Chronicle::warn("Flow '$name' missing directive: @$directive");
                }
            }
        }
        return $missing;
    }

    public static function registerTestFlows(): void
    {
        self::register('onboarding', new TestFlow());
    }
}
