<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Myneral\Myneral;

class ViewRenderCommand implements CommandInterface
{
    public function name(): string { return 'view:render'; }
    public function description(): string { return 'Render a Myneral view/template with optional context.'; }
    public function execute(array $input, array &$output): int
    {
        // Force registration of test layouts and flows for every render
        \Mynorel\Myneral\Layouts\LayoutManager::registerTestLayouts();
        \Mynorel\Myneral\Flows\FlowManager::registerTestFlows();
        if (empty($input[0])) {
            echo "Usage: view:render <template> [json_context]\n";
            return 1;
        }
        $templatePath = $input[0];
        if (!file_exists($templatePath)) {
            echo "[view:render] Template not found: $templatePath\n";
            return 1;
        }
        $template = file_get_contents($templatePath);
        $context = [];
        if (!empty($input[1])) {
            $json = $input[1];
            $context = json_decode($json, true);
            if (!is_array($context)) {
                echo "[view:render] Invalid JSON context.\n";
                return 1;
            }
        }
        try {
            $rendered = Myneral::render($template, $context, $templatePath);
            echo $rendered . "\n";
            return 0;
        } catch (\Throwable $e) {
            echo "[view:render] Error: " . $e->getMessage() . "\n";
            return 1;
        }
    }
}
