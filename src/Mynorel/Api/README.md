# Mynorel API

Mynorel API scaffolds RESTful endpoints for your narrative, resources, and services. Integrated with config, services, and the extension system, and leverages Author for auth and Chronicle for logging.

## Features
- REST API scaffolding (see ApiService)
- Resource serialization
- Extensible controllers
- Auth via Author
- Logging via Chronicle

## Philosophy
APIs are narrative gateways. All logic is modular, extensible, and narrative-centric.

## Usage Example
```php
use Mynorel\Api\ApiService;

$response = ApiService::handle($request);
```

## CLI Usage

List all API endpoints or handle a request:

```bash
php mynorel api:handle --request='{"endpoint":"/v1/posts","method":"GET"}' --user=alice
```
