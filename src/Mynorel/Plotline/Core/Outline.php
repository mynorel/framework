<?php
namespace Mynorel\Plotline\Core;

/**
 * Outline: Represents a schema definition for migrations.
 */
class Outline
{
    protected array $fields = [];

    public function string(string $name): void { $this->fields[$name] = 'string'; }
    public function text(string $name): void { $this->fields[$name] = 'text'; }
    public function datetime(string $name): void { $this->fields[$name] = 'datetime'; }

    public function getFields(): array { return $this->fields; }
}
