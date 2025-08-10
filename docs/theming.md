# Mynorel Theming

Mynorel supports narrative-driven theming for your application.

## Theme Manifests
- Define themes in `src/Mynorel/Myneral/Manifest/ThemeManifest.php`.
- Each theme can provide assets, layouts, and narrative styles.

## Usage
- Switch themes via configuration or runtime.
- Use `@asset` and `@extends` to leverage theme resources.

## Extending Themes
- Create new theme classes or manifests.
- Register with the ThemeService for dynamic switching.
