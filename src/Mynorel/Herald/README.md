## Channel Sentinels (Permissions & Auth)

Herald supports narrative channel permissions using sentinels:

```php
// Only allow users with a token to join 'private' channel
Herald::setSentinel('private', function($connection, $payload) {
        return isset($payload['token']) && $payload['token'] === 'letmein';
});
```

If a client tries to join or send to a channel and the sentinel denies access, they receive:

```json
{
    "error": "Access denied by Sentinel",
    "channel": "private"
}
```


# Herald (WebSocket Layer)

Herald is Mynorel’s narrative WebSocket layer, powered by Workerman. Broadcast, listen, and narrate real-time events and story fragments—bring your app to life with live updates, collaborative scenes, and more.

## Dashboard CLI

Launch the real-time dashboard:
```
php mynorel herald:dashboard
```

Simulate an event:
```
php mynorel herald:dashboard simulate <channel> <event>
```

---
*"Every story needs a herald. Every app needs a voice."*

## Requirements

- [workerman/workerman](https://github.com/walkor/Workerman) (installed via Composer)

## Usage

```php
use Mynorel\Facades\Herald;

// Start the WebSocket server (real, powered by Workerman)
Herald::start(8080);

// Broadcast a message to a channel
Herald::broadcast('story', 'A new chapter begins!');

// Listen for messages on a channel
Herald::listen('story', function($msg) {
    echo "[Herald] $msg\n";
});
```

## CLI Usage

Interact with Herald directly from the Mynorel CLI:

```bash
php mynorel herald start 8080
php mynorel herald broadcast story "A new chapter begins!"
php mynorel herald listen story
```

---
*"Every story needs a herald. Every app needs a voice."*
