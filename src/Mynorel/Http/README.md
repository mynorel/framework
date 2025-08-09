# Mynorel HTTP Layer

A comprehensive HTTP foundation for Mynorel providing request/response handling and HTTP kernel functionality. The HTTP layer becomes the story reader, interpreting incoming requests as narrative cues. Directive-aware responses can be rendered via Myneral templates, enriched with directive logic and theme styling.

## HTTP Layer Structure

```
src/
└── Http/
    ├── Kernel.php              # Entry point for dispatching
    ├── Request.php             # Wrapper around global input
    ├── Response.php            # Output formatting
    ├── Dispatcher.php          # Resolves chapters and scenes
    ├── Middleware/             # Prelude integration
    └── Contracts/
        ├── RequestHandler.php
        └── SceneInterface.php
```

## Features

- Handles requests
- Resolves chapters (via `Narrative`)
- Executes scenes (via `Scene`/controller)
- Applies Middleware (via `Prelude`)
- Responds with layouts (via `Myneral`)

## Narrative Dispatching

```php
GET /publish → invokes Narrative::chapter('publish')
```

## Example Flow

1. `Kernel` receives a request.
2. `Dispatcher` finds the matching chapter via `Narrative::find()`.
3. `Prelude` runs middleware.
4. Scene/controller is invoked.
5. `Myneral` renders the response.

## Integration Points

- **Narrative**: Routing and chapter/scene resolution
- **Prelude**: Middleware execution
- **Myneral**: Template rendering
- **Theme**: Styling
- **Author**: Authorization in scenes/middleware
- **Chronicle**: Logging

## Extending

- Add new middleware in `Middleware/` and register with Prelude
- Implement new scenes/controllers for chapters
- Customize request/response logic as needed

## Philosophical Twist

1. Requests as Invocation
2. Response as Echo
3. Middleware as Prelude
4. Controller as Scene
5. Router as Narrative

Keeps the HTTP layer aligned with Mynorel's poetic tone.