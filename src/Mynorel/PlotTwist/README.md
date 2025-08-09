# PlotTwist (Narrative Event System)

PlotTwist is Mynorel’s narrative event system. Events are "plot twists" and listeners are "audience reactions." Use PlotTwist to decouple features, trigger hooks, and let extensions or services react to key moments in your app’s story.

## Usage

```php
use Mynorel\PlotTwist\PlotTwist;

// Register a listener (audience reaction)
PlotTwist::on('chapter_begins', function($chapter) {
    echo "A new chapter: $chapter\n";
});

// Trigger a plot twist (event)
PlotTwist::trigger('chapter_begins', 'The Adventure');
```

## Philosophy
- Events are narrative moments.
- Listeners are audience reactions.
- Extensions can hook into your story without coupling.

---
*"Every great story has a twist. Let yours be heard."*
