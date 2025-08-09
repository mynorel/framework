# Mynorel Facade Network

Mynorel provides a comprehensive network of facades that offer elegant, static interfaces to the underlying framework services.

## Narrative Onboarding

Mynorel facades offer a way to teach the framework through named, intuitive interfaces. Instead of diving into service containers or config arrays, developers can ask the framework questions:

```php
System::uptime();
Theme::palette();
Narrative::chapter('onboarding');
Author::can('edit-post', $user);
Chronicle::note('User logged in');
```

It's onboarding through invocation—each facade becomes a character in the story, delegating to the real service logic.

## Expressive Syntax

Mynorel’s directive philosophy thrives on clarity and elegance. Facades let you expose core services in a way that feels declarative and readable, without leaking internal complexity.

## Facade Roles

| Facade    | Role in the Narrative         | Example Usage                  |
|-----------|------------------------------|-------------------------------|
| System    | Core runtime and environment | System::uptime()              |
| Theme     | Visual and structural theming| Theme::palette()              |
| Narrative | Onboarding and storytelling  | Narrative::chapter('intro')   |
| Directive | Syntax and templating engine | Directive::compile('x-if')    |
| Memory    | State and persistence        | Memory::remember('user')      |
| Author    | Permissions and roles        | Author::can('edit-post', $u)  |
| Chronicle | Narrative logging            | Chronicle::note('event')      |
| Prelude   | Middleware/prelude           | Prelude::run('Authenticate')  |
| Manifest  | Introspection                | Manifest::modules()           |
| Extension | Plugins (side stories)       | Extension::register(MyPlugin::class); Extension::bootAll(); |

These aren’t just facades—they’re metaphors. They teach the developer how to think in Mynorel’s language.

## Integration Patterns: Facades + Directive Engine

### Directive Compilation Hooks

Facades can expose methods that the directive engine calls during compilation. For example:

```php
Directive::compile('x-if', function($expression) {
    return "<?php if (Condition::evaluate($expression)): ?>";
});
```

Here, Condition is a facade that wraps logic services. It lets the directive engine stay clean and declarative, while the facade handles the complexity.

### Contextual Data Providers

Facades can provide scoped data to directives at render time:

```php
$context = [
    'user' => Memory::get('user'),
    'theme' => Theme::palette(),
    'narrative' => Narrative::chapter('dashboard')
];
```

Then in the directive engine:

```php
Directive::compile('x-show', function($expression) use ($context) {
    return "<?php if ({$context[$expression]}): ?>";
});
```

This makes facades the contextual narrators of the directive story.

### Directive DSL Extensions

Facades can define their own mini-directives that extend the engine's DSL:

```php
Theme::registerDirectives([
    'x-theme' => fn($name) => "<?php echo Theme::get($name); ?>"
]);
```

This lets each facade contribute to the directive language—like plugins in the Mynorel syntax ecosystem.

### Stateful Directives Evaluation

Facades like Memory or Condition can evaluate expressions with internal state:

```php
Directive::compile('x-if', fn($expr) => "<?php if (Condition::check($expr)): ?>");
```

This allows for expressive logic like:

```php
<x-if="user.isLoggedIn">
  Welcome back!
</x-if>
```

Where Condition::check('user.isLoggedIn') parses and evaluates the expression using facade-backed services.

## Narrative Benefit

This integration makes directives feel alive—like they're speaking to the framework's soul. Facades become the semantic bridge between template syntax and backend logic, reinforcing Mynorel's goal of onboarding through expressive architecture.

Each facade:
- Is a static class
- Delegates to a service or core logic in `Services/` or the feature's main class
- Stays expressive and readable
- Optionally logs via `Chronicle`

## Example: Author

```php
use Mynorel\Facades\Author;

if (Author::can('edit-post', $user)) {
    // ...
}
```

## Example: Chronicle

```php
use Mynorel\Facades\Chronicle;

Chronicle::note('User logged in');
Chronicle::warn('Missing directive: @flow');
Chronicle::chapter('Migration started');
Chronicle::interrupt('Database connection lost');
```

## Extending

- Add new facades in `Facades/` for new features or services
- Delegate to the appropriate service or logic class
- Use facades in directives, templates, and CLI for expressive, narrative-driven code