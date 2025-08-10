# Welcome to Myneral

Myneral is the expressive layer of Mynorel - a DSL-powered, directive-first system for composing layouts,
flows, and logic with elegance and clarity. Myneral houses the syntax, structure, and semantics that make make Mynorel feel like a language
not just a framework.

## Structure Overview

```
src/
└── Myneral/
    ├── Directives/   - Core building blocks - custom syntax units like @if, @note, @flow.
    ├── DSL/          - Grammar and parsing logic for Myneral's directive langauge.
    ├── Flows/        - Declaritive flow definitions - how logic and layout move together.
    ├── Layout/       - Composable layout templates - visual and structural scaffolding.
```

## Philosophy

Myneral is not a templating engine. It's a semantic DSL for expressing intent.

- Directives are verbs.
- Layouts are canvases.
- Flows are choreography.
- DSL is the grammar that binds them.

Ever directive is a miniature philosophy. Every layout
is a narrative frame. Every flow is a story in motion.


## How it Works


1. Parsing: Myneral parses `.myneral.php` files using its DSL grammar, supporting both inline and block directives (e.g., `@can ... @endcan`).

2. Compilation: Directives are compiled into PHP via the Myneral engine, with block content passed to directives as needed.

3. Error Reporting: The parser reports unclosed or mismatched blocks, and errors are logged via Chronicle and embedded as comments in output.

4. Execution: Flows orchestrate directive execution across layouts.

5. Rendering: Layouts resolve into views, enriched by directive logic.


### Example: Block Directives and Error Handling

```php
@flow('onboarding')
@layout('welcome')

@note('Welcome to Mynorel!')
@if(user.isNew)
    @show('intro-tour')
<!-- If you forget @endif, an error will be reported and logged -->
```
This reads like a story. Myneral makes onboarding feel like authorship. If you forget to close a block, Myneral will log and embed an error comment in the output.

## Exending Myneral

- Add new directives in `Directives/`
- Define new flow types in `Flows/`
- Customize layout behavior in `Layouts/`
- Modify grammar in `DSL/Grammar.php`

## Integration Points

Myneral integrates with:

- PreludePipeline - for middleware-like directive preprocessing
- Chronicle - for logging directive execution
- Theme - for layout styling and palette resolution

# Mynorel Myneral Layer

Myneral is the expressive engine for parsing, compiling, and rendering narrative templates. It enables poetic, context-aware, and modular UI composition using custom directives, flows, and layouts.

## Features

- Custom directives (e.g., @can, @role, @flow, @layout)
- Narrative-driven template syntax
- Integration with Author, Prelude, Theme, and other features
- Flows and layouts for composable UI
- Extensible directive registration


## Example Usage

```blade
@layout('main')
@flow('onboarding')

@section('header')
    Welcome, {{ user.name }}!
@endsection

@section('content')
    @if(user.isNew)
        <div class="alert">Welcome to Mynorel, {{ user.name }}!</div>
        @show('intro-tour')
    @endif
    @can('edit-post')
        <button>Edit Post</button>
    @endcan
@endsection
```

**Registering layouts and flows:**
```php
use Mynorel\Myneral\Layouts\LayoutManager;
use Mynorel\Myneral\Flows\FlowManager;
LayoutManager::register('main', new AppLayout());
FlowManager::register('onboarding', new OnboardingFlow());
```

**Rendering a template:**
```php
use Mynorel\Myneral\Myneral;
$template = file_get_contents('resources/views/dashboard.myneral.php');
$context = ['user' => ['name' => 'Alice', 'isNew' => true]];
echo Myneral::render($template, $context);
```

**Integration:**
- Use Myneral in CLI, web, or any PHP context
- Integrates with Prelude (middleware), Services, and Author for access control

## Author Integration

The @can and @role directives are built-in and powered by the Author feature:

- `@can('ability') ... @endcan` — Only renders content if the current user can perform the given ability (using `Author::can($ability)->as($user)`).
- `@role('role') ... @endrole` — Only renders content if the current user has the given role (calls `$user->is($role)`).

Both directives are block-aware and work with the current template context (expects a `user` key in the context array).


## Registering Directives

You can register your own directives (inline or block):

```php
Myneral::registerDirective('my-directive', new MyDirective());
```

Or register multiple at once:

```php
Myneral::registerDirectives([
    'foo' => new FooDirective(),
    'bar' => new BarDirective(),
]);
```

Block directives should extend `BaseDirective` and implement `setContent($content)` for block content.

## Flows and Layouts

- Flows: Define a sequence of directives to apply to content.
- Layouts: Compose sections and wrap content with narrative structure.


## Integration Points

- **Author**: @can, @role
- **Prelude**: Middleware for directives and flows
- **Theme**: Palette and theming directives
- **Chronicle**: Logging directive compilation, errors, and block parsing issues

## Extending

- Add new directives in `Directives/`
- Register with `Myneral::registerDirective()`
- Use context to pass data to directives

---

*Myneral makes your templates as expressive and narrative as your code.*