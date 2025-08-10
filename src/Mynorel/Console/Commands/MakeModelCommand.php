<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Output\StylizedPrinter;

class MakeModelCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'make:model'; }
    public function description(): string { return 'Scaffold a new model (character) for your narrative.'; }
    public function execute(array $input, array &$output): int
    {
        $name = $input[0] ?? null;
        if (!$name) {
            $output[] = "No model name provided. Usage: php mynorel make:model Hero";
            StylizedPrinter::warn($output[count($output)-1]);
            return 1;
        }
        $class = ucfirst($name);
        $file = __DIR__ . "/../../Plotline/Plots/{$class}.php";
        if (file_exists($file)) {
            $output[] = "Model $class already exists.";
            StylizedPrinter::warn($output[count($output)-1]);
            return 1;
        }
        $template = "<?php\nnamespace Mynorel\\Plotline\\Plots;\n\nclass $class\n{\n    // ...narrative model logic...\n}\n";
        file_put_contents($file, $template);
        $output[] = "A new character ($class) enters your story: Plotline/Plots/$class.php";
        StylizedPrinter::poetic($output[count($output)-1]);
        return 0;
    }
}
