# Mynorel Theming

Mynorel supports narrative theming for both CLI and web output, allowing you to reskin your app’s story and UI.

## ThemeSkins
- Pluggable formatters for CLI/web output
- Register new skins in PHP:

```php
use Mynorel\ThemeSkins\ThemeSkins;
ThemeSkins::register('noir', fn($text) => "\033[1;30m$text\033[0m");
ThemeSkins::activate('noir');
echo ThemeSkins::format('A dark and stormy night...');
```

- Switch or preview skins via CLI:
```bash
php myne skin noir
php myne skin list
php myne skin preview "A dark and stormy night..."
```

## Web Theming
- Use `resources/themes/` for CSS, layouts, and assets
- Register and activate themes in your app logic

## Extending
- Create new skins for CLI or web
- Integrate with Myneral templates for dynamic theming

See ThemeSkins and Myneral docs for more.
