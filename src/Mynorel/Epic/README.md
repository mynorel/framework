# Epic (Task/Job System)

Epic is Mynorel’s narrative job/task system. Jobs are "epics" and background tasks are "side quests." Use Epic to run, track, and narrate long-running or background work in your app.

## Usage


Epics can be registered at runtime or auto-registered in your app's bootstrap. For demo/testing, 'send_newsletter' is auto-registered.

```php
use Mynorel\Epic\Epic;
Epic::start('send_newsletter', 'alice@example.com');
```

Or via CLI:
```bash
php myne epic send_newsletter alice@example.com
php myne epic list
```

## Philosophy
- Jobs are narrative arcs.
- Side quests are background tasks.
- Progress and status are part of the story.

---
*"Every hero needs an epic. Every app needs a quest."*
