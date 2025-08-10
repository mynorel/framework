
# Mynorel Plugin

Mynorel Plugin manages the discovery, activation, and configuration of plugins and themes. Integrated with config, services, and the extension system, and logs actions via Chronicle.

## Features
- Plugin/theme discovery and activation (see PluginService)
- Extensible plugin system
- Logging via Chronicle

## Philosophy
Plugins and themes are narrative extensions. All logic is modular, extensible, and narrative-centric.

## Security & Robustness
- Only admin users can activate/deactivate plugins
- All plugin actions are logged via Chronicle
- Input is validated

## Usage Example
```php
use Mynorel\Plugin\PluginService;

$plugins = PluginService::list();
try {
	PluginService::activate('my-plugin');
} catch (Exception $e) {
	// Handle unauthorized or error
}
```
