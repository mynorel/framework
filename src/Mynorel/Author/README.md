
# Mynorel Author: Narrative User & Auth System

The Author module manages all aspects of users in Mynorel, including authentication, registration, session management, roles, and permissions. All logic is narrative-driven and fully integrated with Mynorel's config, services, and extension system.

## Features
- Author (user) creation and management
- Authentication (login, logout, session)
- Registration
- Role and permission assignment and checks
- Policies as plotlines (access rules as story arcs)
- Integration with narrative, policy, and Chronicle layers

## Philosophy
Authors are the main actors in the narrative. Authentication, roles, and permissions are part of their story, not just technical details. All logic is modular, extensible, and narrative-centric.

## Authentication & Session Integration

Mynorel's Auth logic is now part of the Author module:

```php
use Mynorel\Author\AuthService;

// Attempt login
if (AuthService::attempt('admin', 'password')) {
    // Authenticated!
}

// Register a new author (stub, replace with real logic)
AuthService::register('newuser', 'secret');

// Get current user
$author = AuthService::user();

// Check role
if (AuthService::hasRole('admin')) {
    // Has admin role
}

// Logout
AuthService::logout();
```

The AuthService uses session to persist the user's identity between requests. Replace the stub logic with your own persistence as needed.


## Architecture

- `AuthService.php` — Handles authentication, registration, session, and role logic
- `Author.php` — Facade for defining/checking abilities
- `Gate.php` — Internal permission/denial registry and checker
- `Roles/Role.php` — Role value object
- `Policies/Policy.php` — Base policy class
- `Contracts/PolicyInterface.php` — Policy contract
- `Policies/EditPostPolicy.php` — Example policy


## Authorization & Policy Usage

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

```php
@can('edit-post')
    <button>Edit</button>
@endcan

@role('editor')
    <div>Welcome, Editor</div>
@endrole
```

Or even more poetic:
```php
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

