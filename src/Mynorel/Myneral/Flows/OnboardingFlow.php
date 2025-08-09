<?php
namespace Mynorel\Myneral\Flows;

// Example flow: onboarding
FlowManager::register('onboarding', new Flow([
    'note',    // should exist
    'can',     // should exist
    'foo',     // should NOT exist (to test error)
]));
