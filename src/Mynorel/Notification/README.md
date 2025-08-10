# Mynorel Notification

Mynorel Notification delivers messages, alerts, and emails to users as part of the narrative. Integrated with config, services, and the extension system, and logs actions via Chronicle.

## Features
- In-app and email notifications (see NotificationService)
- Extensible notification channels
- Logging via Chronicle

## Philosophy
Notifications are narrative events. All logic is modular, extensible, and narrative-centric.

## Usage Example
```php
use Mynorel\Notification\NotificationService;

NotificationService::send($user, 'Welcome to Mynorel!');
```

## CLI Usage

Send a notification:

```bash
php mynorel notification:send --user=alice --message='Welcome to Mynorel!'
```
