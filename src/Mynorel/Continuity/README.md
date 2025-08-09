# ContinuityChecker (Plot Hole Validator)

ContinuityChecker helps you catch "plot holes"—inconsistencies or missing data—before a scene or action runs. Add rules to validate your context and keep your story seamless.

## Usage

```php
use Mynorel\Continuity\ContinuityChecker;

$checker = new ContinuityChecker();
$checker->addRule(function($ctx) {
    return isset($ctx['user']) ? true : 'User missing';
});
$errors = $checker->check(['user' => null]);
if ($errors) {
    // Handle plot holes
}
```

## Philosophy
- Every story needs continuity.
- Validate your narrative before the next scene.

---
*"No plot holes, just seamless stories."*
