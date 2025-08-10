<?php
namespace Mynorel\Narrative\StoryMap;

/**
 * StoryMapService: Visual and data-driven story mapping for chapters, scenes, and flows.
 */
class StoryMapService {
    protected static array $story = [
        'chapters' => [
            [
                'title' => 'The Beginning',
                'scenes' => ['Arrival', 'First Encounter']
            ],
            [
                'title' => 'The Turning Point',
                'scenes' => ['Revelation', 'Conflict']
            ],
            [
                'title' => 'The Resolution',
                'scenes' => ['Climax', 'Farewell']
            ]
        ]
    ];



    /**
     * Export the story map as JSON, with optional i18n context.
     * @param array $context Optional context with 'locale' and 'translations'.
     */
    public static function export(array $context = []) {
        // In a real i18n scenario, translate chapter/scene titles here if needed
        return json_encode(self::$story, JSON_PRETTY_PRINT);
    }

    /**
     * Export the story map as SVG (scaffold).
     */
    public static function exportSVG(): string {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="600" height="400">';
        $y = 40;
        foreach (self::$story['chapters'] as $i => $chapter) {
            $svg .= '<text x="20" y="' . $y . '" font-size="18" fill="#333">Chapter ' . ($i+1) . ': ' . htmlspecialchars($chapter['title']) . '</text>';
            $y += 30;
            foreach ($chapter['scenes'] as $scene) {
                $svg .= '<text x="60" y="' . $y . '" font-size="14" fill="#666">- ' . htmlspecialchars($scene) . '</text>';
                $y += 22;
            }
            $y += 10;
        }
        $svg .= '</svg>';
        return $svg;
    }

    /**
     * Export the story map as PNG (scaffold, requires Imagick or similar in real use).
     */
    /**
     * Export the story map as PNG (scaffold, requires Imagick or similar in real use).
     * @param null|string $file
     */
    public static function exportPNG(?string $file = null): ?string {
        // In real implementation, render SVG and convert to PNG using Imagick or external tool
        $svg = self::exportSVG();
        if (\class_exists('Imagick')) {
            if (!extension_loaded('imagick') || !class_exists('Imagick')) {
                throw new \RuntimeException("Imagick extension is not installed or enabled. Please install it to export StoryMap as images.");
            }
            $imClass = 'Imagick';
            $im = new $imClass();
            $im->readImageBlob($svg);
            $im->setImageFormat('png');
            $png = $im->getImageBlob();
            if ($file !== null) file_put_contents($file, $png);
            return $file !== null ? $file : $png;
        }
        return null;
    }

    public static function import($json) {
        $data = json_decode($json, true);
        if (is_array($data) && isset($data['chapters'])) {
            self::$story = $data;
            return true;
        }
        return false;
    }

    /**
     * Get a summary of the story map, with i18n support.
     * @param array $context Optional context with 'locale' and 'translations'.
     */
    public static function summary(array $context = []): string {
        $locale = $context['locale'] ?? 'en';
        $t = $context['translations'][$locale] ?? [];
        $tr = function($key, $fallback) use ($t) {
            return $t[$key] ?? $fallback;
        };
        $out = "\n📖 " . $tr('storymap.title', 'Story Map:') . "\n";
        foreach (self::$story['chapters'] as $i => $chapter) {
            $out .= $tr('storymap.chapter', 'Chapter') . ' ' . ($i+1) . ': ' . ($t[$chapter['title']] ?? $chapter['title']) . "\n";
            foreach ($chapter['scenes'] as $scene) {
                $out .= "  - " . ($t[$scene] ?? $scene) . "\n";
            }
        }
        return $out;
    }
}
