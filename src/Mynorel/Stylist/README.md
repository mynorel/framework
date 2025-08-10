# Mynorel Stylist: Universal CSS Compiler

Stylist is Mynorel’s narrative-driven CSS compiler and asset pipeline. It empowers developers, theme authors, and plugin creators to use any modern CSS workflow—Tailwind, Sass, PostCSS, and more—directly within their Mynorel apps, with zero config and full CLI integration.

## Philosophy
- **Narrative Theming:** Styles are part of your story. Stylist lets you write, compile, and swap themes using your favorite CSS tools.
- **Universal Support:** Use Tailwind for utility-first, Sass for variables and nesting, or plain CSS/PostCSS for custom pipelines.
- **CLI-First:** Compile, watch, and optimize styles with expressive CLI commands (`php myne stylist:compile`, `php myne stylist:watch`).
- **Extensible:** Plugins and themes can declare their own styles, which are auto-compiled and namespaced.

## Features
- Compile Tailwind, Sass, and PostCSS out of the box
- Watch mode for live development
- Minification and autoprefixing for production
- Theming support: compile multiple themes and switch at runtime
- CLI integration for all workflows
- Works with resources/themes/ and resources/assets/

## Usage

### Compile Styles
```bash
php myne stylist:compile --type=tailwind --input=resources/themes/noir/tailwind.css --output=public/css/noir.css
php myne stylist:compile --type=sass --input=resources/themes/noir/style.scss --output=public/css/noir.css
```

### Watch for Changes
```bash
php myne stylist:watch --type=tailwind --input=resources/themes/noir/tailwind.css --output=public/css/noir.css
```

### Theming
- Place theme source files in `resources/themes/<theme>/`
- Compile each theme to `public/css/<theme>.css`
- Switch themes in your app logic or via CLI

### Plugin/Extension Support
- Plugins can register their own stylesheets
- Stylist will compile and namespace them automatically

## Extending
- Add support for new preprocessors via PHP or Node.js wrappers
- Customize CLI commands for advanced workflows
- Integrate with Myneral templates for dynamic style injection

## Requirements & Compatibility
- PHP 8.4+ compatible (no deprecation warnings)
- Uses `scssphp/scssphp` v2 for Sass/SCSS (fully updated)
- Tailwind CLI (bundled or installed via npm)

## Example CLI Commands
```bash
php myne stylist:compile --type=tailwind --input=resources/themes/noir/tailwind.css --output=public/css/noir.css
php myne stylist:watch --type=sass --input=resources/themes/noir/style.scss --output=public/css/noir.css
```

## Deprecation-Free
Stylist and Mynorel are now fully compatible with PHP 8.4+ and have no deprecation warnings in core or CSS compilation. All CLI commands and signatures are up to date.

Stylist brings narrative theming and modern CSS to every Mynorel story.
