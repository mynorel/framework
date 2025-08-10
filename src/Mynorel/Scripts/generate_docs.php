<?php
// src/Mynorel/Scripts/generate_docs.php
// Simple auto-docs generator for Mynorel: extracts PHPDoc for classes, methods, and facades.

$srcDir = __DIR__ . '/../../';
$docsDir = __DIR__ . '/../../../docs/api/';

function extractDocs($file) {
    $code = file_get_contents($file);
    $docs = [];
    if (preg_match_all('/\/\*\*.*?\*\/(\s*)(class|function|public|protected|private)/s', $code, $matches, PREG_OFFSET_CAPTURE)) {
        foreach ($matches[0] as $match) {
            $docs[] = trim($match[0]);
        }
    }
    return $docs;
}

function scanDirRecursive($dir) {
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    $files = [];
    foreach ($rii as $file) {
        if ($file->isDir()) continue;
        if (substr($file->getFilename(), -4) === '.php') {
            $files[] = $file->getPathname();
        }
    }
    return $files;
}

$allDocs = [];
foreach (scanDirRecursive($srcDir) as $file) {
    $rel = str_replace($srcDir, '', $file);
    $docs = extractDocs($file);
    if ($docs) {
        $allDocs[$rel] = $docs;
    }
}

$output = "# Mynorel API Auto-Docs\n\n";
foreach ($allDocs as $file => $docs) {
    $output .= "## $file\n\n";
    foreach ($docs as $doc) {
        $output .= "```
$doc
```
\n";
    }
}
file_put_contents($docsDir . 'AUTO.md', $output);
echo "Auto-docs generated at docs/api/AUTO.md\n";
