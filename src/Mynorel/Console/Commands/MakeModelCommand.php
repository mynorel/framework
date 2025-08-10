<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Output\StylizedPrinter;

class MakeModelCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'make:model'; }
    public function description(): string { return 'Scaffold a new model (character) for your narrative.'; }
    public function execute(array $input, array $output): int
    {
        $name = $input['name'] ?? null;
        if (!$name) {
            StylizedPrinter::warn("No model name provided. Usage: php myne make:model Hero");
            return 1;
        }
        $class = ucfirst($name);
        $file = __DIR__ . "/../../Plotline/Plots/{$class}.php";
        if (file_exists($file)) {
            StylizedPrinter::warn("Model $class already exists.");
            return 1;
        }
        $template = "<?php\nnamespace Mynorel\\Plotline\\Plots;\n\nclass $class\n{\n    // ...narrative model logic...\n}\n";
        file_put_contents($file, $template);
        StylizedPrinter::poetic("A new character ($class) enters your story: Plotline/Plots/$class.php");
        return 0;
    }
}
