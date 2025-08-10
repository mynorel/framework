
# Mynorel Admin

Mynorel Admin scaffolds a narrative-driven dashboard for managing resources, navigation, and widgets. It is tightly integrated with Mynorel's config, services, and extension system, and leverages Author for permissions and Chronicle for logging.

## Features
- CRUD scaffolding for any resource (see ResourceService)
- Navigation and widget management
- Extensible admin UI
- Permission checks via Author
- Logging via Chronicle

## Philosophy
The admin is a control room for your story, not just a backend. All logic is modular, extensible, and narrative-centric.

## Usage Example
```php
use Mynorel\Admin\AdminService;

if (AdminService::canAccess()) {
	$resources = AdminService::resources();
	// Render admin dashboard
}
```
