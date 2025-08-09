<?php

namespace Mynorel\Console\Commands;

use Mynorel\Plotline\Core\Plot;
use Mynorel\Plotline\Core\Outline;
use Mynorel\Plotline\Plots;

class PlotListCommand
{
    public static function handle(): void
    {
        $plots = Plots::all();
        echo "Available Plots:\n";
        foreach ($plots as $plot) {
            echo "- " . get_class($plot) . "\n";
        }
    }
}
