<?php

namespace Mynorel\Console\Commands;

class PlotQueryCommand
{
    public static function handle(string $plotClass, array $query = []): void
    {
        if (!class_exists($plotClass)) {
            echo "Plot class $plotClass does not exist.\n";
            return;
        }
    $narrator = new \Mynorel\Plotline\Narrator($plotClass);
        // Example: $query = ['where' => ['field', '=', 'value'], 'aggregate' => ['count', 'id']]
        if (isset($query['where'])) {
            [$field, $op, $value] = $query['where'];
            $narrator->where($field, $op, $value);
        }
        if (isset($query['aggregate'])) {
            [$type, $field] = $query['aggregate'];
            $narrator->aggregate($type, $field);
        }
        $result = $narrator->tell();
        echo json_encode($result, JSON_PRETTY_PRINT) . "\n";
    }
}
