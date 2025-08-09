# ThemeSkins (Thematic Skins)

ThemeSkins lets you reskin Mynorel’s CLI/web output with pluggable narrative themes. Skins are simple formatters that change how your story is presented.

## Usage

```php
use Mynorel\ThemeSkins\ThemeSkins;

// Register a skin
ThemeSkins::register('noir', fn($text) => "\033[1;30m$text\033[0m");
ThemeSkins::activate('noir');
echo ThemeSkins::format('A dark and stormy night...');
```

## Philosophy
- Every story deserves a unique look.
- Skins are narrative themes for your app’s output.

---
*"Change the skin, change the story."*
