<?php
namespace Mynorel\Console;

use Mynorel\Console\Contracts\CommandInterface;

/**
 * Console: Mynorel's command chamber and CLI kernel.
 * Registers and executes commands, providing a narrative CLI experience.
 */
class Console
{
    /**
     * @var CommandInterface[]
     */
    protected array $commands = [];

    public function __construct()
    {
        $this->registerDefaults();
    }

    /**
     * Register a command.
     * @param CommandInterface $command
     */
    public function register(CommandInterface $command): void
    {
        $this->commands[$command->name()] = $command;
    }

    /**
     * Register default Mynorel commands.
     */
    protected function registerDefaults(): void
    {
    $this->register(new \Mynorel\Console\Commands\InstallCommand());
    $this->register(new \Mynorel\Console\Commands\PhilosophyCommand());
    $this->register(new \Mynorel\Console\Commands\ChapterListCommand());
    $this->register(new \Mynorel\Console\Commands\PlotlineCommand());
    $this->register(new \Mynorel\Console\Commands\LogCommand());
    $this->register(new \Mynorel\Console\Commands\JournalCommand());
    $this->register(new \Mynorel\Console\Commands\ManifestCommand());
    $this->register(new \Mynorel\Console\Commands\ListCommand());
    $this->register(new \Mynorel\Console\Commands\HelpCommand());
    $this->register(new \Mynorel\Console\Commands\FlowValidateCommand());
    $this->register(new \Mynorel\Console\Commands\TestCommand());
    $this->register(new \Mynorel\Console\Commands\NarrativeConsoleCommand());
    }

    /**
     * Run a command by name.
     * @param string $name
     * @param array $input
     * @return int Exit code
     */
    public function run(string $name, array $input = []): int
    {
        $output = [];
        if (isset($this->commands[$name])) {
            return $this->commands[$name]->execute($input, $output);
        }
        echo "[error] Command '$name' not found.\n";
        return 1;
    }

    /**
     * List all registered commands.
     * @return array
     */
    public function list(): array
    {
        return array_map(fn($cmd) => [
            'name' => $cmd->name(),
            'description' => $cmd->description()
        ], $this->commands);
    }
}
