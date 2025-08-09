# Mynorel Narrative Layer

Narrative defines the application's story structure—where each route is a chapter, each controller a scene, and each middleware a plot device. It replaces traditional routing with expressive, story-driven declarations.

## Narrative Directory Structure

```
src/
└── Narrative/
    ├── Narrative.php         # Defines chapters and story structure.
    ├── Scene.php             # Represents a controller-like unit of story.
    ├── Character.php         # Defines roles, traits, and evolution.
    ├── Chapter.php           # Encapsulated chapter object.
    └── StoryMap.php          # Registry or visual map of all chapters.
```

## Characters: Traits, Evolution, and Integration

Characters represent roles or archetypes in your narrative, and can evolve over time.

```php
// Register a character for a role
$editor = new Character('editor', ['can_publish' => true, 'theme' => 'dark']);
Narrative::character('editor', $editor);

// Use in a chapter
Narrative::chapter('publish')->requires('editor')->leadsTo(PublishController::class);

// Evolve the character
$editor->evolve(['theme' => 'light'], 'User switched to light mode');

// Access evolution from a chapter
$chapter = Narrative::find('publish');
$evolution = $chapter->characterEvolution();
// $evolution is a timeline of trait changes and reasons
```

This allows you to model not just static roles, but dynamic, evolving characters in your application's story, and access their evolution from chapters/arcs.

## Chapters as Routes

```php
Narrative::chapter('home')->leadsTo(HomeController::class);
Narrative::chapter('profile')->requires('reader')->leadsTo(ProfileController::class);
Narrative::chapter('publish')->requires('editor')->leadsTo(PublishController::class);
```

## Arcs and Access

Use Author to guard chapters with role-based arcs:

```php
Narrative::arc('admin-panel')
    ->requires('curator')
    ->leadsTo(AdminController::class);
```

## Scenes as Controllers

Controllers are treated as scenes—self-contained narrative units that express part of the story.

```php
class DashboardScene
{
    public function __invoke()
    {
        return view('scenes.dashboard');
    }
}
```

## Middleware as Plot Devices

Middleware becomes narrative tension—conflict, transformation, or revelation.

```php
Narrative::chapter('publish')
    ->passesThrough('VerifyDraft')
    ->leadsTo(PublishController::class);
```

## Directive Integration

Use @chapter, @arc, or @scene in Myneral templates to reference routes poetically:

```php
@chapter('home')
    <a href="{{ route('home') }}">Begin</a>
@endchapter
```

## Philosophy

Routing is not just navigation—it's storytelling. Narrative invites developers to think in terms of flow, character, and emotional progression.