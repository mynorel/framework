
# Herald (WebSocket Layer)

Herald is Mynorel’s narrative WebSocket layer, powered by Workerman. Broadcast, listen, and narrate real-time events and story fragments—bring your app to life with live updates, collaborative scenes, and more.

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
php myne herald start 8080
php myne herald broadcast story "A new chapter begins!"
php myne herald listen story
```

---
*"Every story needs a herald. Every app needs a voice."*
