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
            $interfaces = [];
            $traits = [];
            $reserved = ['for', 'if', 'while', 'switch', 'case', 'else', 'elseif', 'function', 'class', 'interface', 'trait', 'abstract', 'final', 'public', 'protected', 'private', 'static', 'var', 'const', 'return', 'break', 'continue', 'default', 'do', 'echo', 'print', 'try', 'catch', 'finally', 'throw', 'new', 'clone', 'use', 'namespace', 'extends', 'implements', 'instanceof', 'insteadof', 'global', 'isset', 'unset', 'empty', 'array', 'list', 'callable', 'yield', 'declare', 'goto', 'const'];
            // Use Composer autoloader for robust class loading
            $autoloadPath = __DIR__ . '/../../../../vendor/autoload.php';
            if (file_exists($autoloadPath)) {
                require_once $autoloadPath;
            } else {
                echo "[docs:generate] Composer autoloader not found. Please run 'composer install'.\n";
                return 1;
            }
            // Now collect all declared classes/interfaces/traits in Mynorel namespace
            foreach (get_declared_classes() as $class) {
                if (strpos($class, 'Mynorel\\') === 0 && !in_array(strtolower((new \ReflectionClass($class))->getShortName()), $reserved, true)) {
                    $classes[] = $class;
                }
            }
            foreach (get_declared_interfaces() as $iface) {
                if (strpos($iface, 'Mynorel\\') === 0) {
                    $interfaces[] = $iface;
                }
            }
            foreach (get_declared_traits() as $trait) {
                if (strpos($trait, 'Mynorel\\') === 0) {
                    $traits[] = $trait;
                }
            }
            $docFile = $docsDir . '/API.md';
            $toc = [];
            $classDocs = [];
            $all = [
                'Classes' => $classes,
                'Interfaces' => $interfaces,
                'Traits' => $traits
            ];
            foreach ($all as $type => $list) {
                foreach ($list as $class) {
                    try {
                        $ref = new \ReflectionClass($class);
                        $short = $ref->getShortName();
                        $toc[] = '- [' . $short . '](#' . $short . ')';
                        $doc = '## ' . $short . ' (' . $type . ")\n\n";
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
                                $typeStr = method_exists($prop, 'getType') && $prop->getType() ? $prop->getType() : '';
                                $doc .= "- `{$prop->getName()}`" . ($typeStr ? ": `{$typeStr}`" : '') . "\n";
                            }
                            $doc .= "\n";
                        }
                        // Methods
                        $groups = ['public'=>[],'protected'=>[],'private'=>[]];
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
                                    $default = $param->isDefaultValueAvailable() ? ' = ' . var_export($param->getDefaultValue(), true) : '';
                                    $params[] = trim($ptype . '$' . $param->getName() . $default);
                                }
                                $ret = $method->hasReturnType() ? ': ' . $method->getReturnType() : '';
                                $sig = $method->isStatic() ? 'static ' : '';
                                $sig .= $method->getName() . '(' . implode(', ', $params) . ')' . $ret;
                                $doc .= "- ```php\n$sig\n```\n";
                                if ($method->getDocComment()) {
                                    $doc .= trim(preg_replace('/^\s*\* ?/m', '', str_replace(['/**', '*/'], '', $method->getDocComment()))) . "\n";
                                }
                                $doc .= "\n";
                            }
                        }
                        $classDocs[] = $doc;
                    } catch (\Throwable $e) {
                        // Optionally log or print $e->getMessage();
                        continue;
                    }
                }
            }
            $out = "# Mynorel API Reference\n\n## Table of Contents\n" . implode("\n", $toc) . "\n\n" . implode("\n---\n\n", $classDocs);
            file_put_contents($docFile, $out);
            echo "[docs:generate] API docs generated at $docFile\n";
            return 0;
        }
    }