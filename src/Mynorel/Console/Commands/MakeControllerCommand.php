<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Output\StylizedPrinter;

class MakeControllerCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'make:controller'; }
    public function description(): string { return 'Scaffold a new controller (narrator) for your narrative.'; }
    public function execute(array $input, array &$output): int
    {
        $name = $input[0] ?? null;
        if (!$name) {
            $output[] = "No controller name provided. Usage: php mynorel make:controller HeroController";
            StylizedPrinter::warn($output[count($output)-1]);
            return 1;
        }
        $class = ucfirst($name);
        $file = __DIR__ . "/../../Http/Controllers/{$class}.php";
        if (file_exists($file)) {
            $output[] = "Controller $class already exists.";
            StylizedPrinter::warn($output[count($output)-1]);
            return 1;
        }
        if (!is_dir(dirname($file))) {
            mkdir(dirname($file), 0777, true);
        }
        $template = "<?php\nnamespace Mynorel\\Http\\Controllers;\n\nclass $class\n{\n    // ...narrative controller logic...\n}\n";
        file_put_contents($file, $template);
        $output[] = "A new controller ($class) enters your story: Http/Controllers/$class.php";
        StylizedPrinter::poetic($output[count($output)-1]);
        return 0;
    }
}
