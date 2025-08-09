<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;

class DocsGenerateCommand implements CommandInterface
{
    public function name(): string { return 'docs:generate'; }
    public function description(): string { return 'Auto-generate API documentation in docs/api/'; }
    public function execute(array $input, array &$output): int
    {
        $srcDir = __DIR__ . '/../../..';
        $docsDir = __DIR__ . '/../../../../docs/api';
        $classes = [];
        $rii = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($srcDir));
        $reserved = ['for', 'if', 'while', 'switch', 'case', 'else', 'elseif', 'function', 'class', 'interface', 'trait', 'abstract', 'final', 'public', 'protected', 'private', 'static', 'var', 'const', 'return', 'break', 'continue', 'default', 'do', 'echo', 'print', 'try', 'catch', 'finally', 'throw', 'new', 'clone', 'use', 'namespace', 'extends', 'implements', 'instanceof', 'insteadof', 'global', 'isset', 'unset', 'empty', 'array', 'list', 'callable', 'yield', 'declare', 'goto', 'const'];
        foreach ($rii as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $content = file_get_contents($file->getPathname());
                if (preg_match('/namespace ([^;]+);/', $content, $nsMatch) &&
                    preg_match('/class ([A-Za-z0-9_]+)/', $content, $classMatch)) {
                    $className = $classMatch[1];
                    if (!in_array(strtolower($className), $reserved, true)) {
                        $classes[] = $nsMatch[1] . '\\' . $className;
                    }
                }
            }
        }
        $docFile = $docsDir . '/API.md';
        $toc = [];
        $classDocs = [];
        foreach ($classes as $class) {
            try {
                if (!class_exists($class)) continue;
                $ref = new \ReflectionClass($class);
                $short = $ref->getShortName();
                $toc[] = "- [$short](#$short)";
                $doc = "## $short\n\n";
                $docblock = $ref->getDocComment();
                if ($docblock) {
                    $doc .= trim(preg_replace('/^\s*\* ?/m', '', str_replace(['/**', '*/'], '', $docblock))) . "\n\n";
                }
                $doc .= "**Namespace:** `{$ref->getNamespaceName()}`\n\n";
                // Properties
                $props = $ref->getProperties();
                if ($props) {
                    $doc .= "### Properties\n";
                    foreach ($props as $prop) {
                        if ($prop->getDeclaringClass()->getName() !== $class) continue;
                        $type = method_exists($prop, 'getType') && $prop->getType() ? $prop->getType() : '';
                        $doc .= "- `{$prop->getName()}`" . ($type ? ": `{$type}`" : '') . "\n";
                    }
                    $doc .= "\n";
                }
                // Methods
                $methods = $ref->getMethods();
                foreach ($methods as $method) {
                    if ($method->getDeclaringClass()->getName() !== $class) continue;
                    $vis = $method->isPublic() ? 'public' : ($method->isProtected() ? 'protected' : 'private');
                    $groups[$vis][] = $method;
                }
                foreach ($groups as $vis => $group) {
                    if (!$group) continue;
                    $doc .= "### " . ucfirst($vis) . " Methods\n";
                    foreach ($group as $method) {
                        $params = [];
                        foreach ($method->getParameters() as $param) {
                            $ptype = $param->hasType() ? $param->getType() . ' ' : '';
                            $params[] = trim($ptype . '$' . $param->getName());
                        }
                        $ret = $method->hasReturnType() ? ': ' . $method->getReturnType() : '';
                        $sig = $method->isStatic() ? 'static ' : '';
                        $sig .= $method->getName() . '(' . implode(', ', $params) . ')' . $ret;
                        $doc .= "- ```php\n$sig\n```
";
                        if ($method->getDocComment()) {
                            $doc .= trim(preg_replace('/^\s*\* ?/m', '', str_replace(['/**', '*/'], '', $method->getDocComment()))) . "\n";
                        }
                        $doc .= "\n";
                    }
                }
                $classDocs[] = $doc;
            } catch (\Throwable $e) {
                continue;
            }
        }
        $out = "# Mynorel API Reference\n\n## Table of Contents\n" . implode("\n", $toc) . "\n\n" . implode("\n---\n\n", $classDocs);
        file_put_contents($docFile, $out);
        echo "[docs:generate] API docs generated at $docFile\n";
        return 0;

    }

}