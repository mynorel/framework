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
    $ability = isset($args[0]) ? $args[0] : '';
    $content = $this->content !== null ? $this->content : '';
    // Assume $user is available in the template scope
    return "<?php if (isset(\$user) && \\Mynorel\\Author\\Author::can('$ability')->as(\$user)): ?>$content<?php endif; ?>";
    }
}
