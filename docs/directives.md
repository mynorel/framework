# Mynorel Directives

Directives are special instructions in Myneral templates that control logic, flow, and rendering. They are inspired by Blade, but tailored for narrative-driven apps.

## Built-in Directives

- `@layout('main')` — Use a layout
- `@section('header')` / `@endsection` — Define a section
- `@yield('content')` — Output a section
- `@flow('onboarding')` — Run a narrative flow
- `@can('edit')` — Check authorization
- `@role('admin')` — Role-based logic
- `@if`, `@elseif`, `@else`, `@endif` — Conditionals
- `@show('intro')` — Show a partial/section

## Custom Directives

You can register your own directives in PHP:

```php
use Mynorel\Myneral\Directives\DirectiveManager;
DirectiveManager::register('shout', function($expression) {
    return strtoupper($expression);
});
```

## Usage Example

```myne
@layout('main')
@section('content')
    @if(user.isNew)
        Welcome, {{ user.name }}!
        @show('intro-tour')
    @endif
    @can('edit-post')
        <button>Edit Post</button>
    @endcan
@endsection
```

## Extending

- Add new directives for your app’s needs
- Use directives for access control, theming, or custom flows

See Myneral and Facades docs for more.
