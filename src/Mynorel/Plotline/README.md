# Plotline ORM - Database Component

The Plotline ORM is a comprehensive database orm layer that treats every model as a character, every relationship a subplot. Every query, a turning point.


# Philosophy

> Models are not just data - they're protagonists.
> Relationships are narrative threads.
> Queries are expressions of intent, not extraction.

# Core Concepts

``
Concept Model[Plotline Term]: Plot - a character in your story.

Concept Relationship[Plotline Term]: Subplot - a connection between plots.

Concept QueryBuilder[Plotline Term]: Narrator - guides the unfolding of data.

Concept Migration[Plotline Term]: Chapter - structural change in the story.

Concept Schema[Plotline Term]: Outline - the shape of. your narrative.

``

# Example Model

```php

namespace Plotline\Plots;

use Plotline\Core\Plot;

class PostPlot extends Plot 
{

public function outline() 
{

return [
    'title' => 'string',
    'body' => 'text',
    'published_at' => 'datetime',
];

}

pubic function subplot() 
{

return [
    'author' => $this->belongsTo(UserPlot::class),
    'comments' => $this->hasMany(CommentPlot::class),
];

}

}

```


# Querying with the Narrator

```php
// Basic query
PostPlot::narrate()
    ->where('published_at', '<', now())
    ->with('comments')
    ->orderBy('published_at', 'desc')
    ->tell();

// Join (subplot)
PostPlot::narrate()
    ->join('UserPlot', 'author_id', 'id')
    ->where('UserPlot.name', '=', 'Alice')
    ->tell();

// Aggregate
PostPlot::narrate()
    ->aggregate('count', 'id')
    ->tell();

// Error handling (invalid aggregate)
PostPlot::narrate()
    ->aggregate('total', 'id') // Invalid, will log warning and return error
    ->tell();
```

- narrate() : begins the story
- tell() : executes the query
- join(related, localKey, foreignKey): join another plot (table)
- aggregate(type, field): aggregate functions (count, sum, avg, min, max)
- Errors and warnings are logged via Chronicle

# CLI Tools

The following CLI commands are available for developer productivity:

- `PlotListCommand`: Lists all available plot models
- `PlotSchemaCommand <PlotClass>`: Shows the schema (outline) for a plot
- `PlotQueryCommand <PlotClass> [query]`: Runs a query using the Narrator (see code for usage)

These can be invoked via your preferred PHP CLI runner or integrated into your app's console.

