<?php

namespace Mynorel\Plotline\Plots;

use Mynorel\Plotline\Core\Plot;
use Mynorel\Plotline\Plots\PostPlot;

class UserPlot extends Plot
{
    public function outline(): array
    {
        return [
            'name' => 'string',
            'email' => 'string',
        ];
    }

    public function subplot(): array
    {
        return [
            'posts' => $this->hasMany(PostPlot::class),
        ];
    }
}
