<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;

class NewAppCommand implements CommandInterface
{
    public function name(): string
    {
        return 'new';
    }

    public function description(): string
    {
        return 'Scaffold a new Mynorel narrative-driven app skeleton.';
    }

    public function execute(array $input, array &$output): int
    {
        $targetDir = $input[0] ?? null;
        if (!$targetDir) {
            $output[] = "\nPlease specify a directory for your new Mynorel app.\nUsage: myne new <directory>\n";
            return 1;
        }
        if (file_exists($targetDir)) {
            $output[] = "\nDirectory '$targetDir' already exists. Aborting.\n";
            return 1;
        }
        mkdir($targetDir, 0777, true);
        // Create skeleton structure
        $dirs = [
            'public',
            'narrative/Chapters',
            'narrative/Characters',
            'narrative/Scenes',
            'prelude',
            'chronicle',
            'resources/views',
            'resources/themes',
            'resources/assets',
            'tests',
            'scripts',
        ];
        foreach ($dirs as $dir) {
            mkdir("$targetDir/$dir", 0777, true);
        }
    // Create key files
    file_put_contents("$targetDir/mynorel.json", "{\n  \"name\": \"my-mynorel-app\",\n  \"description\": \"A narrative-driven Mynorel app.\"\n}\n");
    file_put_contents("$targetDir/composer.json", "{\n  \"require\": {\n    \"mynorel/framework\": \"*\"\n  }\n}\n");
    file_put_contents("$targetDir/README.md", "# My Mynorel App\n\nWelcome to your narrative-driven Mynorel application!\n");
    file_put_contents("$targetDir/onboarding.md", "# Onboarding\n\nQuickstart and onboarding for your Mynorel app.\n");
    file_put_contents("$targetDir/public/index.php", "<?php\n// Mynorel app entry point\nrequire __DIR__ . '/../narrative/Narrative.php';\n");
    file_put_contents("$targetDir/narrative/StoryMap.php", "<?php\n// Define your app's narrative flow/routes here.\n");
    file_put_contents("$targetDir/narrative/Narrative.php", "<?php\n// App kernel/entry point.\n");
    file_put_contents("$targetDir/prelude/Prelude.php", "<?php\n// Bootstrapping and pipelines.\n");
    file_put_contents("$targetDir/chronicle/Chronicle.php", "<?php\n// Logging and events.\n");
    // Scaffold the myne CLI script
    $myneScript = <<<'EOPHP'
#!/usr/bin/env php
<?php

// Mynorel CLI entry point for your app.

require __DIR__ . '/vendor/autoload.php';

use Mynorel\Console\Console;

$console = new Console();
$exitCode = $console->run($argv);
exit($exitCode);
EOPHP;
    file_put_contents("$targetDir/myne", $myneScript);
    chmod("$targetDir/myne", 0755);
    $output[] = "\nMynorel app skeleton created in '$targetDir' (with myne CLI script).\n";
    return 0;
    }
}
