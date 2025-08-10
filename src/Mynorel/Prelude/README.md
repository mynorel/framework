# Extending Prelude with Plugins

Prelude pipelines and middleware can be extended or replaced via Mynorel Extensions. Register your extension in `config/extensions.php` and see `/src/Mynorel/Extensions/README.md` for details.
## Global Middleware (Global Preludes)

You can register global Preludes that run for every request, flow, or directive:

```php
use Mynorel\Prelude\Prelude;
use Mynorel\Prelude\Middleware\Authenticate;

// Register global middleware
Prelude::registerGlobal([
    Authenticate::class,
    // ...other global middleware
]);

// Now, every Prelude::run(), ::sequence(), etc. will run these first.
```

This ensures cross-cutting concerns (auth, logging, etc.) are always handled.

## Sample Integration

Suppose you want to ensure authentication and locale are always set for every flow:

```php
use Mynorel\Prelude\Prelude;
use Mynorel\Prelude\Middleware\Authenticate;
use Mynorel\Prelude\Middleware\SetLocale;

// Register global Preludes
Prelude::registerGlobal([
    Authenticate::class,
    SetLocale::class,
]);

// In your flow, directive, or controller:
Prelude::run([VerifyCart::class], $context); // Authenticate and SetLocale will run first
```
## Global Middleware (Global Preludes)

You can register global Preludes that run for every request, flow, or directive:

```php
use Mynorel\Prelude\Prelude;
use Mynorel\Prelude\Middleware\Authenticate;

Prelude::registerGlobal([
    Authenticate::class,
    // ...other global middleware
]);

// Now, every Prelude::run(), ::sequence(), etc. will run these first.
```

This ensures cross-cutting concerns (auth, logging, etc.) are always handled.

# Mynorel Prelude (Middleware Layer)

Prelude is the narrative-driven middleware pipeline for Mynorel. Every middleware is a Prelude, every handler a Ritual, every guard a Sentinel, and every pipeline a Sequence.

## Philosophy

- Middleware = Prelude (scene transition)
- Handler = Ritual (action after prelude)
- Guard = Sentinel (precondition)
- Pipeline = Sequence (named set of preludes)

## Usage

```php
use Mynorel\Prelude\Prelude;
use Mynorel\Prelude\Middleware\Authenticate;
use Mynorel\Prelude\Middleware\SetLocale;
use Mynorel\Prelude\Middleware\VerifyCart;

// Run a single prelude
Prelude::run(Authenticate::class, $context);

// Run multiple preludes in order
Prelude::run([
    Authenticate::class,
    SetLocale::class,
    VerifyCart::class,
], $context);

// Compose a named sequence
Prelude::compose('checkout', [Authenticate::class, VerifyCart::class]);

// Run a named sequence
Prelude::sequence('checkout', $context);

// Guard a ritual with a sentinel
Prelude::guard(Sentinel::class, function($ctx) {
    // Ritual logic here
}, $context);
```

## Contracts

- `PreludeInterface`: All Preludes (middleware) must implement `handle($context)`
- `SentinelInterface`: Guards must implement `check($context)`
- `RitualInterface`: Handlers must implement `perform($context)`

## Example Middleware

```php
class Authenticate implements PreludeInterface {
    public function handle($context = null): void {
        // ... authentication logic ...
    }
}
```


## Integration

Prelude can be used in:
- Flows (Myneral)
- Layouts
- Directives
- CLI commands
- Routing (Narrative)

Myneral templates and flows can invoke Prelude pipelines for middleware logic, authentication, and more.

---

*Prelude is modular, expressive, and ready for integration with all Mynorel features, including Myneral templates, flows, and layouts.*

