# Mynorel Billing

Mynorel Billing manages subscriptions, payments, and billing events as part of your narrative. Integrated with config, services, and the extension system, and logs actions via Chronicle.

## Features
- Subscription and payment management (see BillingService)
- Extensible billing providers
- Logging via Chronicle

## Philosophy
Billing is a narrative transaction. All logic is modular, extensible, and narrative-centric.

## Security & Robustness
- Only authenticated users can subscribe/cancel
- All billing actions are logged via Chronicle
- Input is validated

## Usage Example
```php
use Mynorel\Billing\BillingService;

try {
	BillingService::subscribe($user, 'premium');
} catch (Exception $e) {
	// Handle unauthorized or error
}
```

## CLI Usage

Subscribe a user to a plan:

```bash
php myne billing:subscribe --user=alice --plan=premium
```
