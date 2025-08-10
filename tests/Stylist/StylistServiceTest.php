<?php
use Mynorel\Stylist\StylistService;
use PHPUnit\Framework\TestCase;

class StylistServiceTest extends TestCase
{
    public function testSassCompile()
    {
        $fixturesDir = __DIR__ . '/Fixtures';
        if (!is_dir($fixturesDir)) {
            mkdir($fixturesDir, 0777, true);
        }
        $input = $fixturesDir . '/test.scss';
        $output = $fixturesDir . '/test.css';
        file_put_contents($input, '$color: red; .foo { color: $color; }');
        $result = StylistService::compile('sass', $input, $output);
        $this->assertTrue($result);
        $css = file_get_contents($output);
        $this->assertStringContainsString('color: red', $css);
        unlink($input);
        unlink($output);
    }
    public function testLessCompile()
    {
        $fixturesDir = __DIR__ . '/Fixtures';
        if (!is_dir($fixturesDir)) {
            mkdir($fixturesDir, 0777, true);
        }
        $input = $fixturesDir . '/test.less';
        $output = $fixturesDir . '/test.css';
        file_put_contents($input, '@color: blue; .bar { color: @color; }');
        $result = StylistService::compile('less', $input, $output);
        $this->assertTrue($result);
        $css = file_get_contents($output);
        $this->assertStringContainsString('color: #0000ff', $css);
        unlink($input);
        unlink($output);
    }
}
