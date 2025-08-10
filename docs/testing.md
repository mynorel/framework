# Mynorel Testing

Mynorel uses PHPUnit for all core and narrative tests.

## Running Tests

- Run all tests:
  ```bash
  php myne test
  ```
- Or run PHPUnit directly:
  ```bash
  ./vendor/bin/phpunit
  ```

## Writing Tests
- Place tests in the `tests/` directory, following PSR-4.
- Use expressive, narrative test names and comments.
- Test all custom directives, flows, and services.

## Example
See `tests/Myneral/ViewTest.php` for template engine tests.
