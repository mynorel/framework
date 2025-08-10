<?php
namespace Mynorel\Myneral\Directives;

class AssetDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        $path = $args[0] ?? null;
        $type = $args[1] ?? null;
        $version = $args[2] ?? null;
        if (!$path) return '';
        $url = '/assets/' . ltrim($path, '/');
        if ($version) $url .= '?v=' . urlencode($version);
        if ($type === 'css') {
            return "<link rel=\"stylesheet\" href=\"$url\">";
        } elseif ($type === 'js') {
            return "<script src=\"$url\"></script>";
        }
        return $url;
    }
}
