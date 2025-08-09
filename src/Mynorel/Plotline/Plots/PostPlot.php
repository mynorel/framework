<?php


namespace Mynorel\Plotline\Plots;

use Mynorel\Plotline\Core\Plot;
use Mynorel\Plotline\Plots\UserPlot;
use Mynorel\Plotline\Plots\CommentPlot;


class PostPlot extends Plot
{
    public function outline(): array
    {
        return [
            'title' => 'string',
            'body' => 'text',
            'published_at' => 'datetime',
        ];
    }

    public function subplot(): array
    {
        return [
            'author' => $this->belongsTo(UserPlot::class),
            'comments' => $this->hasMany(CommentPlot::class),
        ];
    }
}
