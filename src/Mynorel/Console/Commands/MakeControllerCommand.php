<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Output\StylizedPrinter;

class MakeControllerCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'make:controller'; }
    public function description(): string { return 'Scaffold a new controller (narrator) for your narrative.'; }
    public function execute(array $input, array $output): int
    {
        $name = $input['name'] ?? null;
        if (!$name) {
            StylizedPrinter::warn("No controller name provided. Usage: php myne make:controller WelcomeController");
            return 1;
        }
        $class = ucfirst($name);
        $file = __DIR__ . "/../../Http/Controllers/{$class}.php";
        if (file_exists($file)) {
            StylizedPrinter::warn("Controller $class already exists.");
            return 1;
        }
        if (!is_dir(dirname($file))) {
            mkdir(dirname($file), 0777, true);
        }
        $template = "<?php\nnamespace Mynorel\\Http\\Controllers;\n\nclass $class\n{\n    // ...narrative controller logic...\n}\n";
        file_put_contents($file, $template);
        StylizedPrinter::poetic("A new narrator ($class) joins your story: Http/Controllers/$class.php");
        return 0;
    }
}
