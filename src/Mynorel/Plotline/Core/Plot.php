<?php
namespace Mynorel\Plotline\Core;

/**
 * Plot: Base class for all models (protagonists).
 */

/**
 * Plot: Base class for all models (protagonists).
 * In Mynorel, every model is a character, every table a stage, every query a turning point.
 */
abstract class Plot
{
    /**
     * Return the schema/outline for this plot.
     */
    abstract public function outline(): array;

    /**
     * Return the relationships/subplots for this plot.
     */
    public function subplot(): array
    {
        return [];
    }

    /**
     * Start a query (narration) for this plot.
     */
    public static function narrate(): \Mynorel\Plotline\Narrator
    {
        return new \Mynorel\Plotline\Narrator(static::class);
    }

    /**
     * Get the table name for this plot (by convention, snake_case plural).
     */
    public static function table(): string
    {
        $class = (new \ReflectionClass(static::class))->getShortName();
        return strtolower(preg_replace('/Plot$/', '', $class)) . 's';
    }

    /**
     * Return all records for this plot (all characters on stage).
     */
    public static function allRows(): array
    {
        $qb = new \Mynorel\Plotline\Database\QueryBuilder();
        return $qb->table(static::table())->get();
    }


    /**
     * Find a record by primary key (find a protagonist).
     */
    public static function find($id)
    {
        $qb = new \Mynorel\Plotline\Database\QueryBuilder();
        return $qb->table(static::table())->where('id', '=', $id)->first();
    }

    /**
     * Return all known plotline classes (for CLI listing).
     * @return array
     */
    public static function all(): array
    {
        return [
            \Mynorel\Plotline\Plots\PostPlot::class,
            \Mynorel\Plotline\Plots\UserPlot::class,
            \Mynorel\Plotline\Plots\CommentPlot::class,
        ];
    }

    // Relationship helpers
    protected function belongsTo(string $related): array
    {
        return ['type' => 'belongsTo', 'related' => $related];
    }

    protected function hasMany(string $related): array
    {
        return ['type' => 'hasMany', 'related' => $related];
    }
}
