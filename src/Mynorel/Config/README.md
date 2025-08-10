# Mynorel Config

This directory contains the configuration layer for Mynorel. All configuration values should be accessed via the `Config` class or its Facade, using dot notation (e.g., `Config::get('app.env')`).

## Best Practices
- **Always use `Config::get()`** for accessing configuration values in your code.
- **Do not use `getenv()` or hardcoded values**; centralize all configuration in the config files and access them through the Config layer.
- **Dot Notation**: Use dot notation for nested config (e.g., `Config::get('database.connections.mysql.host')`).
- **Extensibility**: Add new config files or keys as needed, and access them through the same interface.

## Example
```php
use Mynorel\Config\Config;

$env = Config::get('app.env');
$dbHost = Config::get('database.connections.mysql.host');
```

## Facade
A `Config` Facade is provided for easy access:
```php
use Mynorel\Facades\Config;

$env = Config::get('app.env');
```

---

**Author:** Jade Byurei
