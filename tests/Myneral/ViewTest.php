<?php
use Mynorel\Myneral\Myneral;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    protected function setUp(): void
    {
        // Clear view cache
        $cacheDir = __DIR__ . '/../../cache/views/';
        if (is_dir($cacheDir)) {
            foreach (glob($cacheDir . '*.php') as $file) {
                @unlink($file);
            }
        }
        Myneral::clearDirectives();
        Myneral::registerDefaults();
    }
    protected function debugDirectivesAndTokens($template)
    {
        $directives = Myneral::getDirectives();
        echo "Registered directives: ", implode(', ', array_keys($directives)), "\n";
        $tokens = \Mynorel\Myneral\DSL\Grammar::parse($template);
        echo "Tokens: ", var_export($tokens, true), "\n";
    }
    public function testBasicRendering()
    {
        $template = 'Hello, @yield("name")!';
        $context = ['sections' => ['name' => 'World']];
        $this->debugDirectivesAndTokens($template);
        $output = Myneral::compile($template, $context);
        echo "Output: $output\n";
        $this->assertStringContainsString('Hello, World!', $output);
    }

    public function testLangDirective()
    {
        $template = '@lang("greeting")';
        $context = [
            'locale' => 'fr',
            'translations' => [
                'fr' => ['greeting' => 'Bonjour'],
                'en' => ['greeting' => 'Hello']
            ]
        ];
        $this->debugDirectivesAndTokens($template);
        $output = Myneral::compile($template, $context);
        echo "Output: $output\n";
        $this->assertEquals('Bonjour', $output);
    }

    public function testAssetDirective()
    {
        $template = '@asset("style.css", "css", "1.2.3")';
        $this->debugDirectivesAndTokens($template);
        $output = Myneral::compile($template);
        echo "Output: $output\n";
        $this->assertStringContainsString('<link rel="stylesheet" href="/assets/style.css?v=1.2.3">', $output);
    }
}
