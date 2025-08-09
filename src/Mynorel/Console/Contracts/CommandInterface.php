<?php
namespace Mynorel\Console\Contracts;

/**
 * CommandInterface: Contract for all Mynorel console commands.
 */
interface CommandInterface
{
    /**
     * Execute the command.
     * @param array $input
     * @param array $output
     * @return int Exit code
     */
    public function execute(array $input, array &$output): int;

    /**
     * Get the command's name (e.g., 'install', 'chapter:list').
     * @return string
     */
    public function name(): string;

    /**
     * Get a short description of the command.
     * @return string
     */
    public function description(): string;
}
