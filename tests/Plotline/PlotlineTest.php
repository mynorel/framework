<?php

use PHPUnit\Framework\TestCase;
use Mynorel\Plotline\Plots\PostPlot;

class PlotlineTest extends TestCase
{
    public function testPlotlineModelInstantiation()
    {
        $post = new PostPlot();
        $this->assertInstanceOf(PostPlot::class, $post);
    }
    // Uncomment and adjust the following if PostPlot::allRows() is implemented and returns an array
    // public function testPlotlineAllRowsReturnsArray()
    // {
    //     $result = PostPlot::allRows();
    //     $this->assertIsArray($result);
    // }
}
