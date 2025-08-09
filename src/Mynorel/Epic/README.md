# Epic (Task/Job System)

Epic is Mynorel’s narrative job/task system. Jobs are "epics" and background tasks are "side quests." Use Epic to run, track, and narrate long-running or background work in your app.

## Usage

```php
use Mynorel\Epic\Epic;

// Register an epic (job)
Epic::register('send_newsletter', function($user) {
    // ...send logic...
    echo "Newsletter sent to $user\n";
});

// Start an epic
Epic::start('send_newsletter', 'alice@example.com');
```

## Philosophy
- Jobs are narrative arcs.
- Side quests are background tasks.
- Progress and status are part of the story.

---
*"Every hero needs an epic. Every app needs a quest."*
