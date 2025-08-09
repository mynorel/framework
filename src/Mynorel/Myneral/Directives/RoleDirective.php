<?php
namespace Mynorel\Myneral\Directives;

/**
 * RoleDirective: Checks if the current user has a given role.
 * Usage: @role('editor') ... @endrole
 */
class RoleDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        $role = $args[0] ?? '';
        $user = $context['user'] ?? null;
        $output = "<?php if (method_exists([1m$user[0m, 'is') && [1m$user[0m->is('$role')): ?>";
        $output .= $this->content;
        $output .= "<?php endif; ?>";
        return $output;
    }
}
