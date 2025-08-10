

# Mynorel Framework

<div align="center">
	<img alt="CI" src="https://github.com/mynorel/framework/actions/workflows/ci.yml/badge.svg" />
	<img alt="License: MIT" src="https://img.shields.io/badge/license-MIT-blue.svg" />
</div>

> **A narrative-first PHP framework for expressive, modular, and modern applications.**

Mynorel lets you build your app as a story: every model is a character, every request a scene, every query a turning point. Its architecture is modular, composable, and poetic—designed for clarity, power, and joy.

---

## ✨ Philosophy

- **Models are characters.**
- **Controllers are narrators.**
- **Middleware is a prelude.**
- **Handlers are rituals.**
- **Guards are sentinels.**
- **Plugins are side stories.**
# Mynorel Framework

> **A narrative-first PHP framework for expressive, modular, and modern applications.**

Mynorel lets you build your app as a story: every model is a character, every request a scene, every query a turning point. Its architecture is modular, composable, and poetic—designed for clarity, power, and joy.

---


## 📚 Documentation

- [docs/README.md](docs/README.md) — Start here for all framework docs
- [docs/CHANGELOG.md](docs/CHANGELOG.md) — Changelog
- [docs/CONTRIBUTING.md](docs/CONTRIBUTING.md) — Contribution guide
- [docs/directives.md](docs/directives.md) — Myneral template/view directives
- [docs/theming.md](docs/theming.md) — Theming and UI
- [docs/testing.md](docs/testing.md) — Testing and QA
- [docs/architecture.md](docs/architecture.md) — Architecture overview
- [docs/api/API.md](docs/api/API.md) — Auto-generated API Reference

---

## ✨ Philosophy

- **Models are characters.**
- **Controllers are narrators.**
- **Middleware is a prelude.**
- **Handlers are rituals.**
- **Guards are sentinels.**
- **Plugins are side stories.**
- **Queries are turning points.**
- **Configuration is the script.**

Mynorel is built for narrative clarity, modularity, and developer delight.

---

## 🚀 Features
- **PageTurner (Pagination):** Narrative pagination for lists, models, and queries—each page is a chapter.
- **Plotline ORM:** Narrative-driven, expressive, and supports MySQL, PostgreSQL, SQLite, SQL Server.
- **Prelude Middleware:** Modular pipelines, global and per-sequence, with narrative metaphors.
- **Services Layer:** Business logic, logging, authorization, theming, and more—injectable and extendable.
- **Facades:** Thin, expressive, and delegate to services for testability and flexibility.
- **CLI & Console:** Powerful command system for developer tools, automation, and narrative test running.
- **Configuration:** All config in `/config`, environment-driven, no magic.
- **PSR-4 Autoloading:** Modern, Composer-based, no require_once.
- **Extension System:** Register and load plugins ("side stories") at runtime via the ExtensionManager.
- **Sentinels & Rituals:** Expressive guards and handlers with contracts for custom workflows.
- **Scriptorium (Service Container):** Narrative dependency injection and service management for all story elements.
- **Ready for plugins, DI, and extension.**

---

## ⚡ Quickstart

See the docs for usage examples and guides.

## Myneral Templates: Layouts, Flows, and Directives

Mynorel includes a robust, Blade-like template engine called Myneral, supporting:
- Layouts: `@layout('main')`, `@section('header')`, `@yield('content')`
- Flows: `@flow('onboarding')` for narrative-driven UI logic
- Directives: `@can`, `@role`, `@if`, `@show`, and custom
- Context: Pass data to templates for dynamic rendering

**Example template:**
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
$template = file_get_contents('resources/views/dashboard.myne');
$context = ['user' => ['name' => 'Alice', 'isNew' => true]];
echo Myneral::render($template, $context);
```

**Integration:**
- Use Myneral in CLI, web, or any PHP context
- Integrates with Prelude (middleware), Services, and Author for access control
	```php
	use Mynorel\Scriptorium\Scriptorium;
	Scriptorium::singleton('bard', fn() => new Bard());
	$bard = Scriptorium::make('bard');
	```
8. **Run an Epic (Job/Task):**
	```php
	use Mynorel\Epic\Epic;
	Epic::register('send_newsletter', function($user) {
		 // ...send logic...
		 echo "Newsletter sent to $user\n";
	});
	Epic::start('send_newsletter', 'alice@example.com');
	```
	Or via CLI:
	```bash
	php myne epic send_newsletter alice@example.com
	php myne epic list
	```

9. **Switch or Preview Thematic Skins:**
	```php
	use Mynorel\ThemeSkins\ThemeSkins;
	ThemeSkins::register('noir', fn($text) => "\033[1;30m$text\033[0m");
	ThemeSkins::activate('noir');
	echo ThemeSkins::format('A dark and stormy night...');
	```
	Or via CLI:
	```bash
	php myne skin noir
	php myne skin list
	php myne skin preview "A dark and stormy night..."
	```

1. **Install dependencies:**
	```bash
	composer install
	```
2. **Configure your database:**
	Edit `config/database.php` (supports mysql, pgsql, sqlite, sqlsrv).
3. **Autoload:**
	```php
	require __DIR__ . '/vendor/autoload.php';
	```
4. **Use Plotline ORM:**
	```php
	use Mynorel\Plotline\Plots\PostPlot;
	$posts = PostPlot::allRows();
	$post = PostPlot::find(1);
	$results = PostPlot::narrate()
		 ->where('published_at', '<', date('Y-m-d'))
		 ->orderBy('published_at', 'desc')
		 ->tell();
	```
5. **Use Middleware (Prelude):**
	```php
	use Mynorel\Prelude\Prelude;
	Prelude::run([Authenticate::class, SetLocale::class], $context);
	```
6. **Use Services:**
	```php
	use Mynorel\Services\ChronicleService;
	ChronicleService::note('A new chapter begins.');
	```


7. **Boot Extensions (Side Stories):**
	```php
	use Mynorel\Facades\Extension;
	Extension::bootAll();
	```
	This loads all registered plugins (side stories) into your Mynorel app.

8. **Run Tests (Narrative Style):**
	```bash
	php myne test
	```
	Runs your PHPUnit test suite with Mynorel's narrative output. Requires PHPUnit (see below).

---

## 🧩 Extending Mynorel
- **Write and register plugins (side stories):**
	- Implement `ExtensionInterface` in `/src/Mynorel/Extensions` or your own namespace.
	- Register with `Extension::register(YourExtension::class);`
	- Call `Extension::bootAll();` to initialize all plugins (now integrated into Mynorel's core lifecycle).

- **Create custom sentinels and rituals:**
	- Implement `SentinelInterface` for guards (access control, workflow checks).
	- Implement `RitualInterface` for handlers (actions, rituals).
	- Integrate with Prelude or your own flows.
- **Built-in test runner:** Use `php myne test` for narrative test output. Add your own test cases in `tests/`.

- **Add your own services, middleware, or models.**
- **Swap or extend any service for plugins or custom logic.**
- **Integrate with any PHP library via Composer.**

---

## 📚 Documentation
- See `/tests/` for test examples and to add your own.

- See `/src/Mynorel/Plotline/README.md` for ORM details.
- See `/src/Mynorel/Prelude/README.md` for middleware.
- See `/src/Mynorel/Services/README.md` for services and extension.

---

## 🧪 Testing

---

## Real-time with Herald (WebSocket)

Herald brings real-time narrative to Mynorel using Workerman. Broadcast, listen, and narrate live events and story fragments.

```php
use Mynorel\Facades\Herald;
// Start the WebSocket server
Herald::start(8080);
// Broadcast a message
Herald::broadcast('story', 'A new chapter begins!');
// Listen for messages
Herald::listen('story', function($msg) {
	echo "[Herald] $msg\n";
});
```
Or via CLI:
```bash
php myne herald start 8080
php myne herald broadcast story "A new chapter begins!"
php myne herald listen story
```

- Mynorel includes a built-in test runner command: `php myne test`
- Tests use PHPUnit by default. Install with:
	```bash
	composer require --dev phpunit/phpunit
	```
- Add your tests in the `tests/` directory.
- The test runner outputs results in narrative style, matching Mynorel's philosophy.

## 🍳 Usage Recipes

- **Paginate a list with narrative output:**
	```php
	use Mynorel\PageTurner\PageTurner;
	$items = range(1, 100);
	$paginator = new PageTurner($items, 10, 2);
	echo $paginator->chapterSummary(); // Chapter 2 of 10
	echo $paginator->progressBar();    // [==        ] 2/10
	$result = $paginator->cursorChapter(10, 10); // Cursor-based
	```

- **Prompt for user input in CLI:**
	```php
	use Mynorel\Console\Support\InteractivePrompt;
	$name = InteractivePrompt::ask('What is your character name?', 'Alice');
	$role = InteractivePrompt::menu('Choose your path:', ['Hero', 'Villain', 'Guide']);
	```

- **Add a CLI command from an extension:**
	```php
	$console->register(new \Your\Extension\Commands\CustomCommand());
	```


## 📝 License

Mynorel is MIT licensed. Crafted with narrative and care.

---

**Author:** Jade Monathrae Lewis (<jadelewis@mynorel.dev>)