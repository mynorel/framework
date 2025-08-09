
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
- **Queries are turning points.**
- **Configuration is the script.**

Mynorel is built for narrative clarity, modularity, and developer delight.

---

## 🚀 Features

- **Plotline ORM:** Narrative-driven, expressive, and supports MySQL, PostgreSQL, SQLite, SQL Server.
- **Prelude Middleware:** Modular pipelines, global and per-sequence, with narrative metaphors.
- **Services Layer:** Business logic, logging, authorization, theming, and more—injectable and extendable.
- **Facades:** Thin, expressive, and delegate to services for testability and flexibility.
- **CLI & Console:** Powerful command system for developer tools, automation, and narrative test running.
- **Configuration:** All config in `/config`, environment-driven, no magic.
- **PSR-4 Autoloading:** Modern, Composer-based, no require_once.
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
│   │   ├── ...           # More features (Narrative, Myneral, etc.)
│   └── ...
├── vendor/           # Composer dependencies
└── ...
```

---

## ⚡ Quickstart

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

7. **Run Tests (Narrative Style):**
	```bash
	php myne test
	```
	Runs your PHPUnit test suite with Mynorel's narrative output. Requires PHPUnit (see below).

---

## 🧩 Extending Mynorel
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
