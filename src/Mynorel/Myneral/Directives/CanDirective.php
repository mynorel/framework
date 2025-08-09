<?php
namespace Mynorel\Myneral\Directives;

use Mynorel\Author\Author;

/**
 * CanDirective: Checks if the current user can perform an ability.
 * Usage: @can('edit-post') ... @endcan
 */
class CanDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        $ability = $args[0] ?? '';
        $user = $context['user'] ?? null;
        $output = "<?php if (\\Mynorel\\Author\\Author::can('$ability')->as([1m$user[0m)): ?>";
        $output .= $this->content;
        $output .= "<?php endif; ?>";
        return $output;
    }
}
