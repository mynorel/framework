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
        $role = isset($args[0]) ? $args[0] : '';
        $user = isset($context['user']) ? $context['user'] : null;
        $content = $this->content !== null ? $this->content : '';
            if ($user && method_exists($user, 'is')) {
                return "<?php if (method_exists(\$user, 'is') && \$user->is('$role')): ?>$content<?php endif; ?>";
            } else {
                return '';
            }
}

}