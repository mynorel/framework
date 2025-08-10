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
                if ($targetDir) {
                    $targetDir = trim($targetDir);
                    if (strpos($targetDir, '~/') === 0) {
                        $targetDir = getenv('HOME') . substr($targetDir, 1);
                    } elseif ($targetDir === '~') {
                        $targetDir = getenv('HOME');
                    }
                }
                $output[] = "[debug] Resolved targetDir: $targetDir\n";
                if (!$targetDir) {
                    $output[] = "\nPlease specify a directory for your new Mynorel app.\nUsage: mynorel new <directory>\n";
                    return 1;
                }
                if (file_exists($targetDir)) {
                    $output[] = "\nDirectory '$targetDir' already exists. Aborting.\n";
                    return 1;
                }
                $dirs = [
                    $targetDir,
                    "$targetDir/config",
                    "$targetDir/resources/lang/en",
                    "$targetDir/resources/themes/default",
                    "$targetDir/resources/views",
                    "$targetDir/public",
                    "$targetDir/database",
                    "$targetDir/src",
                    "$targetDir/src/Facades",
                    "$targetDir/src/Providers",
                    "$targetDir/src/Narrators",
                    "$targetDir/src/Extensions",
                    "$targetDir/docs",
                    "$targetDir/scripts",
                    "$targetDir/tests",
                ];
                foreach ($dirs as $dir) {
                    if (!is_dir($dir)) {
                        mkdir($dir, 0777, true);
                    }
                }
                // .gitignore
                file_put_contents("$targetDir/.gitignore", "/vendor/\n/node_modules/\n.env\n.env.*\n.DS_Store\n*.log\ncomposer.lock\ndatabase/*.sqlite\n/public/storage\n.idea/\n.vscode/\ncoverage/\n");
                // .env.example
                file_put_contents("$targetDir/.env.example", "# Mynorel App Environment\nAPP_NAME=Mynorel Application\nAPP_ENV=local\nAPP_DEBUG=true\nAPP_URL=http://localhost\nDB_CONNECTION=sqlite\nDB_DATABASE=database/database.sqlite\n# 'Every app is a story. Every variable is a plot point.'\n");
                // config/services.php
                file_put_contents("$targetDir/config/services.php", "<?php\n// Register custom services, facades, or plugins here.\nreturn [\n    // 'bard' => Mynorel\\Services\\BardService::class,\n];\n");
                // resources/lang/en/messages.php
                file_put_contents("$targetDir/resources/lang/en/messages.php", "<?php\nreturn [\n    'welcome' => 'Welcome to your Mynorel app! Start your story in src/Narrative.php.',\n    // Add more narrative messages here.\n];\n");
                // resources/themes/default/theme.php
                file_put_contents("$targetDir/resources/themes/default/theme.php", "<?php\nreturn [\n    'palette' => [\n        'primary' => '#4B3F72',\n        'accent' => '#F67280',\n        'background' => '#F8F8F8',\n    ],\n    'name' => 'Default',\n];\n");
                // public/.htaccess
                file_put_contents("$targetDir/public/.htaccess", "RewriteEngine On\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteRule ^ index.php [QSA,L]\n");
                // database/.gitkeep
                file_put_contents("$targetDir/database/.gitkeep", "");
                // src/Facades/AppFacade.php
                file_put_contents("$targetDir/src/Facades/AppFacade.php", "<?php\nnamespace Mynorel\\Facades;\n// Example custom facade for your Mynorel app\nclass AppFacade {\n    public static function hello() {\n        return 'Hello from your app facade! Edit src/Facades/AppFacade.php to add your own methods.';\n    }\n}\n");
                // src/Providers/AppServiceProvider.php
                file_put_contents("$targetDir/src/Providers/AppServiceProvider.php", "<?php\nnamespace Mynorel\\Providers;\n// Example service provider\nclass AppServiceProvider {\n    public function register() {\n        // Register app services\n        // Example: \$this->app->bind('service', Service::class);\n    }\n    public function boot() {\n        // Boot app services\n    }\n}\n");
                // src/Narrators/WelcomeNarrator.php
                file_put_contents("$targetDir/src/Narrators/WelcomeNarrator.php", "<?php\nnamespace Mynorel\\Narrators;\nclass WelcomeNarrator {\n    public function index() {\n        return 'Welcome to your Mynorel app! Edit src/Narrators/WelcomeNarrator.php to begin your story.';\n    }\n}\n");
                // src/Extensions/ExampleExtension.php
                file_put_contents("$targetDir/src/Extensions/ExampleExtension.php", "<?php\nnamespace Mynorel\\Extensions;\n// Example plugin/extension\nclass ExampleExtension {\n    public function register() {\n        // Register extension logic\n    }\n}\n");
                // src/routes.php
                file_put_contents("$targetDir/src/routes.php", "<?php\n// Define your app's routes here.\n// Example: Route::get('/', [Mynorel\\Narrators\\WelcomeNarrator::class, 'index']);\n");
                // tests/bootstrap.php
                file_put_contents("$targetDir/tests/bootstrap.php", "<?php\n// PHPUnit bootstrap file\n");
                // docs/README.md
                file_put_contents("$targetDir/docs/README.md", "# App Documentation\n\nAdd your app-specific docs here.\n");
                // scripts/setup.sh
                file_put_contents("$targetDir/scripts/setup.sh", "#!/bin/bash\n# Mynorel narrative setup script\necho 'Setting up your Mynorel app... Every script is a ritual.'\nchmod -R 775 storage\n");
                chmod("$targetDir/scripts/setup.sh", 0755);
                // composer.json
                file_put_contents(
                    "$targetDir/composer.json",
                    json_encode([
                        'name' => 'mynorel/application',
                        'description' => 'A robust narrative-driven Mynorel app.',
                        'type' => 'project',
                        'require' => [
                            'mynorel/framework' => '*'
                        ],
                        'autoload' => [
                            'psr-4' => [
                                'Mynorel\\' => 'src/Mynorel/'
                            ]
                        ],
                        'scripts' => [
                            'mynorel' => 'php mynorel',
                            'post-create-project-cmd' => [
                                '@composer install',
                                'echo "Welcome to Mynorel! Start your story in src/Narrative.php."'
                            ]
                        ]
                    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                );
                // mynorel.json
                file_put_contents(
                    "$targetDir/mynorel.json",
                    json_encode([
                        'name' => 'mynorel/application',
                        'description' => 'A robust narrative-driven Mynorel app.',
                        'version' => '1.0.0',
                        'locale' => 'en',
                        'theme' => 'default',
                        'onboarding' => true
                    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                );
                // config files
                file_put_contents("$targetDir/config/app.php", "<?php\nreturn [\n    'name' => 'Mynorel Application',\n    'env' => 'local',\n    'locale' => 'en',\n    'debug' => true,\n];\n");
                file_put_contents("$targetDir/config/database.php", "<?php\nreturn [\n    'driver' => 'sqlite',\n    'database' => __DIR__ . '/../database.sqlite',\n];\n");
                file_put_contents("$targetDir/config/narrative.php", "<?php\nreturn [\n    'chapters' => [],\n    'characters' => [],\n    'scenes' => [],\n];\n");
                // README with badges
                file_put_contents("$targetDir/README.md", "# Mynorel App Skeleton\n\n<div align=\"center\">\n    <img alt=\"CI\" src=\"https://github.com/mynorel/framework/actions/workflows/ci.yml/badge.svg\" />\n    <img alt=\"Packagist\" src=\"https://img.shields.io/packagist/v/mynorel/framework.svg\" />\n    <img alt=\"License: MIT\" src=\"https://img.shields.io/badge/license-MIT-blue.svg\" />\n</div>\n\nThis is a narrative-driven app scaffolded by `mynorel new`.\n\n## Structure\n\n- `composer.json` — PHP dependencies (includes `mynorel/framework`)\n- `mynorel.json` — App config (Mynorel-specific)\n- `config/` — App, database, and narrative config\n- `src/` — Narrative logic (Chapters, Characters, Scenes, StoryMap, Narrative, Facades, Providers, Controllers, Extensions)\n- `public/` — Web entry point (`index.php`, `.htaccess`)\n- `prelude/` — Bootstrapping, pipelines, middleware\n- `chronicle/` — Logging, error handling, events\n- `resources/` — Views, themes, assets, lang\n- `database/` — Migrations, seeds, SQLite\n- `tests/` — App tests\n- `scripts/` — CLI scripts, onboarding, playground\n- `mynorel` — CLI entry point for your app\n\n## Quickstart\n\n1. Install dependencies:\n   ```sh\n   composer install\n   ```\n2. Copy `.env.example` to `.env` and edit as needed.\n3. Run the CLI:\n   ```sh\n   ./mynorel\n   ```\n4. Start the web server:\n   ```sh\n   php -S localhost:8000 -t public\n   ```\n5. Start building your narrative-driven app!\n\nSee `onboarding.md` for more details.\n");
                // onboarding
                file_put_contents("$targetDir/onboarding.md", "# Onboarding\n\nWelcome to your Mynorel app!\n\n- Edit `src/Narrative.php` to define your app's kernel.\n- Add chapters, characters, and scenes in `src/`.\n- Customize config in `config/`.\n- Start the CLI with `./mynorel` or the web server with `php -S localhost:8000 -t public`.\n");
                // public/index.php
                file_put_contents("$targetDir/public/index.php", "<?php\n// Mynorel app web entry point\nrequire __DIR__ . '/../src/Narrative.php';\n");
                // src/Narrative.php
                file_put_contents("$targetDir/src/Narrative.php", "<?php\nnamespace Mynorel;\n// App kernel/entry point.\n// Bootstrap your app here.\n\nclass Narrative {\n    public function start() {\n        echo 'Welcome to Mynorel! Edit src/Narrative.php to build your story.';\n    }\n}\n\n// To get started, run: php mynorel\n");
                // src/StoryMap.php
                file_put_contents("$targetDir/src/StoryMap.php", "<?php\n// Define your app's narrative flow/routes here.\n");
                // prelude/Prelude.php
                file_put_contents("$targetDir/src/Prelude.php", "<?php\n// Bootstrapping and pipelines.\n");
                // chronicle/Chronicle.php
                file_put_contents("$targetDir/src/Chronicle.php", "<?php\n// Logging and events.\n");
                // resources/views/welcome.myneral.php
                file_put_contents("$targetDir/resources/views/welcome.myneral.php", "@layout('main')\n@section('content')\nWelcome to your new Mynorel app!\n@endsection\n");
                // tests/ExampleTest.php
                file_put_contents("$targetDir/tests/ExampleTest.php", "<?php\n\nuse PHPUnit\\Framework\\TestCase;\n\nclass ExampleTest extends TestCase\n{\n    public function testTrue()\n    {\n        self::assertTrue(true);\n    }\n}\n");
                // scripts/playground.php
                file_put_contents("$targetDir/scripts/playground.php", "<?php\n// Try out Mynorel features here.\n");
                // Scaffold the mynorel CLI script
                $mynorelScript = <<<'EOPHP'
#!/usr/bin/env php
<?php

// Mynorel CLI entry point for your app.

if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    fwrite(STDERR, "\n[ERROR] Please run 'composer install' before using the Mynorel CLI.\n");
    exit(1);
}
require __DIR__ . '/vendor/autoload.php';

echo "\nWelcome to Mynorel CLI!\n";
if (class_exists('Mynorel\\Narrative')) {
    (new Mynorel\Narrative())->start();
} else {
    echo "\nEdit src/Narrative.php to begin your story.\n";
}
EOPHP;
                file_put_contents("$targetDir/mynorel", $mynorelScript);
                chmod("$targetDir/mynorel", 0755);
                $output[] = "\nMynorel app skeleton created in '$targetDir' (with mynorel CLI script).\n";
                return 0;
            }
        }