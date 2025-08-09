<?php
namespace Mynorel\Author\Policies;

use Mynorel\Author\Contracts\PolicyInterface;

/**
 * EditPostPolicy: Example policy (plotline) for editing posts.
 * Only allows users with the 'editor' role to edit draft posts.
 */
class EditPostPolicy extends Policy
{
    /**
     * Determine if the user can edit the post.
     * @param mixed $user
     * @param mixed ...$args (expects $post as first argument)
     * @return bool
     */
    public function enact($user, ...$args): bool
    {
        $post = $args[0] ?? null;
        // Example: user must be 'editor' and post must be draft
        return method_exists($user, 'is') && $user->is('editor') && $post && method_exists($post, 'isDraft') && $post->isDraft();
    }
}
