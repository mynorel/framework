# Mynorel Architecture

Mynorel’s architecture is narrative-driven, modular, and extensible. It is designed to let you build applications as stories, with each component playing a literary role.

## Core Concepts
- **Chapters:** Major modules/features
- **Characters:** Domain models/entities
- **Scenes:** Controllers/handlers
- **Prelude:** Middleware and pipelines
- **Chronicle:** Logging and events
- **Facades:** Expressive service access
- **Manifest:** Module and theme registration
- **Myneral:** Blade-inspired template engine

## Layered Structure
- **App Layer:** Your narrative (narrative/, resources/, public/)
- **Framework Layer:** Mynorel core (src/Mynorel/)
- **Extension Layer:** Plugins, themes, and side stories

## Flow Example
1. Request enters via public/index.php
2. Routed by StoryMap (narrative/StoryMap.php)
3. Handled by a Scene (controller)
4. Models (Characters) interact with services
5. Output rendered via Myneral templates
6. Events logged by Chronicle

## Extensibility
- Add new chapters, characters, scenes, or plugins
- Register new CLI commands or facades
- Swap or extend services

See each feature’s README for more details.
