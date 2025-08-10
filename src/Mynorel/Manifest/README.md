
# Mynorel Manifest Layer

The Manifest layer declares the identity of the framework: what is Mynorel, what modules are active, and what is its onboarding story?

It exposes contracts for CLI, templating, and app layers to introspect and interact. This enables narrative flows in commands like `mynorel philosophy` or `mynorel plotline:map`.

## Core: Manifest Class

The `Manifest` class loads and exposes the contents of `mynorel.json`:

```php
use Mynorel\Facades\Manifest;

// Get all modules
$modules = Manifest::modules();

// Get the framework philosophy
$philosophy = Manifest::philosophy();

// Get a human-readable description
echo Manifest::describe();
```


## CLI Integration

The Manifest layer powers CLI commands for introspection:

- `mynorel manifest` — shows all framework modules and philosophy (colorized output)
- `mynorel philosophy` — prints the framework's philosophy
- `mynorel plotline:map` — lists all plotlines (models/ORM)
- `mynorel list` — lists all available CLI commands
- `mynorel help` — shows help for all CLI commands

These commands use the Manifest facade to access meta-information about the framework. Output is colorized for clarity using the SyntaxColorizer.

## Extension Points

The Manifest layer is extensible via specialized manifests:

- `DirectiveManifest` — describes available directives and their handlers
- `OnboardingManifest` — describes onboarding flows and guides
- `ThemeManifest` — describes available themes and palettes

These classes can implement `ManifestInterface` and provide additional meta-information for CLI, templates, or onboarding tools.

## Example: mynorel.json

```json
{
    "name": "mynorel/framework",
    "version": "0.1.0",
    "description": "A modular, expressive framework where architecture is rhythm and syntax is soul.",
    "modules": {
        "plotline": { "description": "Narrative ORM", "namespace": "Mynorel\\Plotline" },
        "myneral": { "description": "Directive and flow engine", "namespace": "Mynorel\\Myneral" }
    },
    "philosophy": {
        "modularity": "Each module is a chapter — distinct, but harmonious.",
        "syntax": "Directives read like intent, not instruction."
    }
}
```

## Usage in Templates and CLI

You can use the Manifest facade in templates, CLI commands, or onboarding flows to provide dynamic, narrative-driven introspection.

---

**Summary:**
- The Manifest layer is the meta-narrator of Mynorel.
- It enables introspection, onboarding, and extension.
- Use the Manifest facade for expressive, narrative-driven meta-operations.