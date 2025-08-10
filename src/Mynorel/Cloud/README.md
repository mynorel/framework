# Mynorel Cloud

Mynorel Cloud integrates with cloud providers for deployment, scaling, and management. Integrated with config, services, and the extension system, and logs actions via Chronicle.

## Features
- Cloud provider integration (see CloudService)
- Deployment and scaling automation
- Logging via Chronicle

## Philosophy
Cloud is the stage for your narrative. All logic is modular, extensible, and narrative-centric.

## Security & Robustness
- Only admin users can deploy/scale
- All cloud actions are logged via Chronicle
- Input is validated

## Usage Example
```php
use Mynorel\Cloud\CloudService;

try {
	CloudService::deploy('my-app', 'my-provider');
} catch (Exception $e) {
	// Handle unauthorized or error
}
```

## CLI Usage

Deploy an app to a provider:

```bash
php myne cloud:deploy --user=alice --app=my-app --provider=aws
```
