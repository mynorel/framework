<?php

// Narrative Class Structure


namespace Mynorel\Narrative;

use Mynorel\Facades\Prelude;

/**
 * Narrative: Defines chapters, arcs, scenes, and story structure.
 * Integrates with StoryMap and supports narrative-driven routing.
 */
class Narrative
{
    protected string $name;
    protected ?string $controller = null;
    protected array $middleware = [];
    protected ?string $role = null;
    protected ?Character $character = null;
    protected static array $arcs = [];
    protected static array $scenes = [];
    protected static array $characters = [];

    /**
     * Define a chapter (route).
     */
    public static function chapter(string $name): self
    {
        $instance = new self();
        $instance->name = $name;
        return $instance;
    }

    /**
     * Define an arc (access flow).
     */
    public static function arc(string $name): self
    {
        $instance = new self();
        $instance->name = $name;
        self::$arcs[$name] = $instance;
        return $instance;
    }

    /**
     * Require a role for this chapter/arc.
     */
    /**
     * Require a role for this chapter/arc, and associate a Character if defined.
     */
    public function requires(string $role): self
    {
        $this->role = $role;
        $this->middleware[] = "role:{$role}";
        // Attach a Character if one is registered for this role
        if (isset(self::$characters[$role])) {
            $this->character = self::$characters[$role];
        }
        return $this;
    }

    /**
     * Add middleware (plot devices).
     */
    public function passesThrough(string|array $middleware): self
    {
        $this->middleware = array_merge(
            $this->middleware,
            is_array($middleware) ? $middleware : [$middleware]
        );
        return $this;
    }

    /**
     * Set the controller/scene for this chapter/arc.
     */
    public function leadsTo(string $controller): void
    {
        $this->controller = $controller;
        // Run Prelude (middleware/plot devices) for this chapter before adding
        if (!empty($this->middleware) && class_exists('Mynorel\\Facades\\Prelude')) {
            Prelude::run($this->middleware, [
                'chapter' => $this->name,
                'controller' => $this->controller,
                'role' => $this->role,
                'character' => $this->character ?? null
            ]);
        }
        $chapter = new Chapter($this->name, $this->controller, $this->middleware, $this->role, $this->character ?? null);
        StoryMap::addChapter($chapter);
    }
    /**
     * Register a Character (role/archetype) for use in chapters/arcs.
     */
    public static function character(string $role, Character $character): void
    {
        self::$characters[$role] = $character;
    }

    /**
     * Register a scene (controller-like unit).
     */
    public static function scene(string $name, $handler): void
    {
        self::$scenes[$name] = new Scene($name, $handler);
    }

    /**
     * Get all chapters.
     */
    public static function all(): array
    {
        return StoryMap::all();
    }

    /**
     * Find a chapter by name.
     */
    public static function find(string $name): ?Chapter
    {
        return StoryMap::find($name);
    }

    /**
     * Find an arc by name.
     */
    public static function findArc(string $name): ?self
    {
        return self::$arcs[$name] ?? null;
    }

    /**
     * Find a scene by name.
     */
    public static function findScene(string $name): ?Scene
    {
        return self::$scenes[$name] ?? null;
    }
}
