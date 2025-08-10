<?php
namespace Mynorel\Myneral\Directives;

use Mynorel\Myneral\Components\Component;

class ComponentDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        $name = $args[0] ?? null;
        $params = $args[1] ?? [];
        if (!$name) return '';
        $class = "Mynorel\\Myneral\\Components\\" . ucfirst($name);
        if (class_exists($class)) {
            $component = new $class();
            return $component->render($params);
        }
        return "<!-- Unknown component: $name -->";
    }
}
