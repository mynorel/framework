<?php

namespace Mynorel\Plotline\Plots;

use Mynorel\Plotline\Core\Plot;
use Mynorel\Plotline\Plots\PostPlot;

class CommentPlot extends Plot
{
    public function outline(): array
    {
        return [
            'body' => 'text',
            'created_at' => 'datetime',
        ];
    }

    public function subplot(): array
    {
        return [
            'post' => $this->belongsTo(PostPlot::class),
        ];
    }
}
