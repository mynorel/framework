<?php
namespace Mynorel\Stylist;

/**
 * StylistService: Universal CSS compiler for Mynorel.
 * Supports Tailwind, Sass, PostCSS, and plain CSS.
 */
class StylistService
{
    public static function compile(string $type, string $input, string $output, array $options = []): bool
    {
        switch (strtolower($type)) {
            case 'sass':
                return self::compileSass($input, $output, $options);
            case 'postcss':
                return self::compilePostCss($input, $output, $options);
            case 'tailwind':
                return self::compileTailwind($input, $output, $options);
            case 'css':
                return copy($input, $output);
            default:
                throw new \InvalidArgumentException("Unknown CSS type: $type");
        }
    }
    public static function compileSass($input, $output, $options = []) {
        if (!class_exists('ScssPhp\ScssPhp\Compiler')) {
            throw new \RuntimeException('scssphp not installed.');
        }
        $scss = new \ScssPhp\ScssPhp\Compiler();
        $css = $scss->compileString(file_get_contents($input))->getCss();
        file_put_contents($output, $css);
        return true;
    }
    public static function compilePostCss($input, $output, $options = []) {
        // For PHP, use voku/postcss-php or shell out to postcss CLI
        $cmd = "postcss " . escapeshellarg($input) . " -o " . escapeshellarg($output);
        exec($cmd, $out, $code);
        return $code === 0;
    }
    public static function compileTailwind($input, $output, $options = []) {
        // Requires tailwindcss CLI installed (npm or binary)
        $cmd = "tailwindcss -i " . escapeshellarg($input) . " -o " . escapeshellarg($output);
        if (!empty($options['minify'])) {
            $cmd .= " --minify";
        }
        exec($cmd, $out, $code);
        return $code === 0;
    }
}
