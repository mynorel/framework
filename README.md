13. **Real-time with Herald (WebSocket):**
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

# Mynorel Framework

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

## 🗂️ Project Structure

```
project/
├── config/           # All configuration (database, app, etc.)
├── src/
│   ├── Mynorel/
│   │   ├── Plotline/     # ORM, models, query builder
│   │   ├── Prelude/      # Middleware, contracts
│   │   ├── Services/     # Business logic, logging, auth, theming
│   │   ├── Console/      # CLI commands
│   │   ├── Extensions/   # Plugins (side stories), ExtensionManager
│   │   ├── Sentinels/    # Guards (access control, workflows)
│   │   ├── Rituals/      # Handlers (actions, rituals)
│   │   ├── ...           # More features (Narrative, Myneral, etc.)
│   └── ...
├── vendor/           # Composer dependencies
└── ...
```

---

## ⚡ Quickstart
11. **Paginate with PageTurner:**
12. **Cache with MemoryPalace:**
	```php
	use Mynorel\Facades\MemoryPalace;
	// Store a value
	MemoryPalace::inscribe('hero', 'Alice', 60); // 60 seconds
	// Retrieve a value
	$name = MemoryPalace::recall('hero');
	// Forget a value
	MemoryPalace::forget('hero');
	// Clear all cached fragments
	MemoryPalace::clear();
	```
	Or via CLI:
	```bash
	php myne memorypalace inscribe hero Alice
	php myne memorypalace recall hero
	php myne memorypalace forget hero
	php myne memorypalace clear
	```
	```php
	use Mynorel\PageTurner\PageTurner;
	$items = range(1, 100);
	$paginator = new PageTurner($items, 10, 1); // 10 per page, page 1
	$current = $paginator->currentChapter();
	$next = $paginator->nextChapter();
	$total = $paginator->totalChapters();
	```
	Or via CLI:
	```bash
	php myne paginate 1,2,3,4,5,6,7,8,9,10,11,12 5 2
	# Shows page 2 of the list, 5 items per page
	```
10. **Use the Scriptorium (Service Container):**
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

## 📝 License

Mynorel is MIT licensed. Crafted with narrative and care.

---

## 🧪 Testing

- Mynorel includes a built-in test runner command: `php myne test`
- Tests use PHPUnit by default. Install with:
	```bash
	composer require --dev phpunit/phpunit
	```
- Add your tests in the `tests/` directory.
- The test runner outputs results in narrative style, matching Mynorel's philosophy.
