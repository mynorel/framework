# Rewind (Time Travel Debugging)

Rewind lets you record and replay scenes (actions) in your Mynorel app. Use it for time travel debugging, testing, or narrative playback.

## Usage

```php
use Mynorel\Rewind\Rewind;

// Record a scene
Rewind::record('checkout', ['user' => $userId, 'cart' => $cart]);

// Replay all scenes
Rewind::replay(function($scene, $data, $time) {
    echo "[Replaying] $scene at $time\n";
    var_export($data);
});

// Clear history
Rewind::clear();
```

## Philosophy
- Scenes are moments in time.
- Rewind lets you revisit and debug your story.

---
*"Every story deserves a second look."*
