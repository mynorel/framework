# Scriptorium (Service Container)

Scriptorium is Mynorel’s narrative service container. It casts, stores, and retrieves story elements—services, characters, and props—so your app remains modular, testable, and poetic.

## Usage

```php
use Mynorel\Scriptorium\Scriptorium;

// Bind a transient service
Scriptorium::bind('bard', fn() => new Bard());

// Bind a singleton
Scriptorium::singleton('scribe', fn() => new Scribe());

// Resolve a service
$bard = Scriptorium::make('bard');
$scribe = Scriptorium::make('scribe');

// Check if a binding exists
if (Scriptorium::has('bard')) { /* ... */ }

// Clear all bindings (for testing)
Scriptorium::clear();
```

## Philosophy
- The Scriptorium is the library of your story’s cast and props.
- Services are characters, singletons are legendary figures.
- Retrieval is poetic and expressive.

---
*"Every story needs a library. Every app needs a Scriptorium."*
