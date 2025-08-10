# Mynorel Testing

Mynorel supports narrative-style testing for all features, using PHPUnit and custom CLI commands.

## Test Types
- **Unit Tests:** Test individual classes/services
- **Feature Tests:** Test flows, CLI commands, and narrative logic
- **Narrative Tests:** Test story-driven scenarios

## Running Tests
- Use the built-in CLI:
```bash
php myne test
```
- Outputs results in narrative style
- Add your tests in the `tests/` directory

## Example Test
```php
use PHPUnit\Framework\TestCase;
use Mynorel\Plotline\Plots\Hero;

class HeroTest extends TestCase {
    public function testHeroCanSave() {
        $hero = new Hero();
        $hero->name = 'Alice';
        $this->assertTrue($hero->save());
    }
}
```

## Extending
- Add more tests for new features
- Use Chronicle for narrative test output
- Integrate with CI/CD for automated testing

See the tests/ directory and CLI docs for more.
