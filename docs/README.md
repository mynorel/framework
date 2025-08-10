# Mynorel Documentation

## Getting Started

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
4. **Run onboarding:**
   ```bash
   php mynorel onboarding
   ```
5. **Explore the Mynorel Tour:**
   ```bash
   php mynorel tour
   ```

## Quickstart

- **Create a model:**
  ```bash
   php mynorel make:model Hero
  ```
- **Create a controller:**
  ```bash
   php mynorel make:controller WelcomeController
  ```
- **List resources:**
  ```bash
   php mynorel resource:list --user=alice
  ```
- **Send a notification:**
  ```bash
   php mynorel notification:send --user=alice --message='Welcome!'
  ```

This directory contains important documentation for the Mynorel framework.

- [Changelog](CHANGELOG.md)
- [Contributing](CONTRIBUTING.md)
- [API Reference](api/API.md) — Auto-generated API documentation
- [API Feature](../src/Mynorel/Api/README.md) — RESTful endpoints, resource serialization, and narrative API
- [Media Feature](../src/Mynorel/Media/README.md) — File/image upload, media management
- [Notification Feature](../src/Mynorel/Notification/README.md) — In-app/email notifications, channels
- [Search Feature](../src/Mynorel/Search/README.md) — Full-text/structured search, indexing
- [Plugin Feature](../src/Mynorel/Plugin/README.md) — Plugin/theme discovery, activation
- [Billing Feature](../src/Mynorel/Billing/README.md) — Subscription/payment management
- [Cloud Feature](../src/Mynorel/Cloud/README.md) — Cloud provider integration, deployment
- [Resource Feature](../src/Mynorel/Resource/README.md) — Resource CRUD UI, permissions
- [Architecture](architecture.md) — Narrative-driven structure, layers, and flow
- [Directives](directives.md) — Myneral template directives and custom logic
- [Theming](theming.md) — Narrative theming for CLI and web
- [Testing](testing.md) — Narrative-style testing and CLI integration
- [Stylist Feature](../src/Mynorel/Stylist/README.md) — Universal CSS compiler, theming, and asset pipeline
