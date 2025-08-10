# Mynorel Directives

Mynorel's Myneral template engine supports expressive narrative directives for views and components.

## Built-in Directives

- `@csrf` &mdash; Output a CSRF field for forms.
- `@flash('key')` &mdash; Output a flash message by key.
- `@auth` &mdash; Check if the user is authenticated.
- `@role('role') ... @endrole` &mdash; Block for users with a given role.
- `@can('ability') ... @endcan` &mdash; Block for users with a given ability.
- `@section('name') ... @endsection` &mdash; Define a section.
- `@yield('name')` &mdash; Output a section's content.
- `@extends('layout')` &mdash; Inherit from a layout.
- `@component('name', params)` &mdash; Render a component.
- `@asset('file', 'type', 'version')` &mdash; Output an asset URL or tag.
- `@lang('key')` &mdash; Output a localized string.

## Custom Directives

You can register your own directives via:

```php
\Mynorel\Myneral\Myneral::registerDirective('mydirective', new MyDirective());
```

See the source in `src/Mynorel/Myneral/Directives/` for more.
