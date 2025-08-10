# ThemeSkins (Thematic Skins)

ThemeSkins lets you reskin Mynorel’s CLI/web output with pluggable narrative themes. Skins are simple formatters that change how your story is presented.

## Usage


Skins can be registered at runtime or auto-registered in your app's bootstrap. For demo/testing, 'noir' is auto-registered.

```php
use Mynorel\ThemeSkins\ThemeSkins;
ThemeSkins::activate('noir');
echo ThemeSkins::format('A dark and stormy night...');
```

Or via CLI:
```bash
php mynorel skin noir
php mynorel skin list
php mynorel skin preview "A dark and stormy night..."
```

## Philosophy
- Every story deserves a unique look.
- Skins are narrative themes for your app’s output.

---
*"Change the skin, change the story."*
