<?php
namespace Mynorel\Myneral\Layouts;

class TestLayout extends Layout
{
    public function __construct()
    {
        parent::__construct('main', [
            'header' => '<header><h1>Test Layout Header</h1></header>',
            'footer' => '<footer><p>Test Layout Footer</p></footer>'
        ]);
    }
}
