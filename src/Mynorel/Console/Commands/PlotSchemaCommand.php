<?php

namespace Mynorel\Console\Commands;

use Mynorel\Plotline\Core\Plot;
use Mynorel\Plotline\Core\Outline;

class PlotSchemaCommand
{
    public static function handle(string $plotClass): void
    {
        if (!class_exists($plotClass)) {
            echo "Plot class $plotClass does not exist.\n";
            return;
        }
        $plot = new $plotClass();
        if (!method_exists($plot, 'outline')) {
            echo "$plotClass does not have an outline() method.\n";
            return;
        }
        $outline = $plot->outline();
        echo "Schema for $plotClass:\n";
        foreach ($outline as $field => $type) {
            echo "- $field: $type\n";
        }
    }
}
