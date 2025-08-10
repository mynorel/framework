<?php
// src/Mynorel/Academy/AcademyService.php

namespace Mynorel\Academy;

class AcademyService {
    /**
     * Start the onboarding tutorial with i18n support.
     * @param array $context Optional context with 'locale' and 'translations'.
     */
    public static function startTutorial(array $context = []): string {
        $locale = $context['locale'] ?? 'en';
        $t = $context['translations'][$locale] ?? [];
        $tr = function($key, $fallback) use ($t) {
            return $t[$key] ?? $fallback;
        };
        $out = "\n🎓 " . $tr('academy.welcome', 'Welcome to Mynorel Academy!') . "\n";
        $out .= $tr('academy.begin', "Let's embark on your onboarding journey...") . "\n";
        $steps = [
            $tr('academy.step1', 'Introduction to Mynorel philosophy'),
            $tr('academy.step2', 'Creating your first narrative'),
            $tr('academy.step3', 'Using the CLI to generate chapters'),
            $tr('academy.step4', 'Styling with the Stylist compiler'),
            $tr('academy.step5', 'Testing your story with Snapshot and Mutation tests'),
            $tr('academy.step6', 'Exploring plugins in the Marketplace'),
            $tr('academy.step7', 'Mapping your story with StoryMap'),
            $tr('academy.step8', 'Monitoring with the Herald Dashboard'),
            $tr('academy.step9', 'Hot reloading your templates'),
        ];
        foreach ($steps as $i => $step) {
            $out .= ($i+1) . ". $step\n";
        }
        $out .= "\n" . $tr('academy.ready', 'You are now ready to create legendary narratives!') . "\n";
        return $out;
    }
}
