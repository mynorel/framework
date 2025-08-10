# Mynorel Resource

Mynorel Resource provides a UI and logic for managing any resource/entity in your narrative. Integrated with config, services, and the extension system, and leverages Author for permissions and Chronicle for logging.

## Features
- Resource CRUD UI (see ResourceService)
- Extensible field types and actions
- Permission checks via Author
- Logging via Chronicle

## Philosophy
Resources are the cast and props of your story. All logic is modular, extensible, and narrative-centric.

## Security & Robustness
- Only authenticated users can list resources
- Only admin users can register/manage resources
- All resource actions are logged via Chronicle
- Input is validated

## Usage Example
```php
use Mynorel\Resource\ResourceService;

try {
	$resources = ResourceService::list();
	ResourceService::register('my-resource');
} catch (Exception $e) {
	// Handle unauthorized or error
}
```

## CLI Usage

List all resources:

```bash
php myne resource:list --user=alice
```
