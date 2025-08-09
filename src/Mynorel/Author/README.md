# Mynorel Authorization Layer (Author)

The Author layer is Mynorel's expressive authorization system. It determines who can write, edit, or view parts of the application's story, using narrative metaphors:
- **Roles** are characters (e.g., scribe, editor, reader, curator)
- **Policies** are plotlines (access rules as story arcs)
- **Permissions** are abilities (actions characters can perform)

Works seamlessly with Myneral's directive syntax to guard flows, layouts, or components. Integrates with Chronicle for logging authorization decisions.

## Architecture

- `Author` — Main facade for defining and checking abilities
- `Gate` — Internal permission/denial registry and checker
- `Roles/Role.php` — Role value object
- `Policies/Policy.php` — Base policy class
- `Contracts/PolicyInterface.php` — Policy contract
- `Policies/EditPostPolicy.php` — Example policy

## Usage

```php
// Grant and deny abilities to roles
Author::allow('edit-post')->for('editor');
Author::deny('publish')->for('guest');

// Check if a user can perform an ability
Author::can('delete')->as($user);

// Register a policy callback
Gate::policy('publish', function($user, ...$args) {
    return $user->is('editor');
});

// Register a policy class
Gate::policyClass('edit-post', \Mynorel\Author\Policies\EditPostPolicy::class);
```

In Directives:

```php myneral
@can('edit-post')
    <button>Edit</button>
@endcan

@role('editor')
    <div>Welcome, Editor</div>
@endrole
```

Or even more poetic:
```php myneral
@as('editor')
    <button>Write Chapter</button>
@endas
```

## Philosophical Layering
-
## Sample Sentinel (Guard)

To create a custom guard (sentinel), implement `SentinelInterface`:

```php
namespace Mynorel\Author;

use Mynorel\Author\Contracts\SentinelInterface;

class EditorSentinel implements SentinelInterface
{
    public function check($context): bool
    {
        // Assume $context is a user object with an is() method
        return is_object($context) && method_exists($context, 'is') && $context->is('editor');
    }
}
```

Use with Prelude's guard method:

```php
Prelude::guard(\Mynorel\Author\EditorSentinel::class, function($ctx) {
    // ...protected logic...
}, $user);
```

- Use roles as archetypes: `scribe`, `editor`, `reader`, `curator` (not just `admin`/`user`)
- Policies are classes that implement `PolicyInterface` and define `enact($user, ...$args): bool`

Example policy:
```php
class EditPostPolicy extends Policy
{
    public function enact($user, ...$args): bool
    {
        $post = $args[0] ?? null;
        return $user->is('editor') && $post && $post->isDraft();
    }
}
```

## Integrating with Chronicle

All permission grants/denials and policy decisions are logged via Chronicle:
```php
Chronicle::note("Author allowed 'edit-post' for 'editor'");
Chronicle::interrupt("Author denied 'publish' for 'guest'");
Chronicle::note("Policy class EditPostPolicy for 'edit-post' returned true");
```

## File Structure

```
src/Mynorel/Author/
├── Author.php         # Facade for defining/checking abilities
├── Gate.php           # Internal registry and checker
├── Contracts/
│   └── PolicyInterface.php
├── Policies/
│   ├── Policy.php     # Base policy
│   └── EditPostPolicy.php # Example
└── Roles/
    └── Role.php       # Role value object
```

## Extending

- Add new policies in `Policies/`
- Use `Author::allow()`/`deny()` for new abilities
- Register policy callbacks or classes for advanced logic
- Integrate with directives for template-level checks

