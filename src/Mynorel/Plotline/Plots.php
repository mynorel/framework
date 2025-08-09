<?php
namespace Mynorel\Plotline;

// No import, use fully qualified name

class Plots
{
    /**
     * Return all plot model classes in the Plots directory.
     * @return array
     */
    public static function all(): array
    {
        $dir = __DIR__ . '/Plots';
        $plots = [];
        if (is_dir($dir)) {
            foreach (scandir($dir) as $file) {
                if (substr($file, -8) === 'Plot.php') {
                    $class = __NAMESPACE__ . '\\Plots\\' . substr($file, 0, -4);
                    if (class_exists($class) && is_subclass_of($class, '\\Mynorel\\Plotline\\Core\\Plot')) {
                        $plots[] = new $class();
                    }
                }
            }
        }
        return $plots;
    }
}
