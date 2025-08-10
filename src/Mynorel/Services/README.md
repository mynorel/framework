# Mynorel Service Layer
-
## Extending Services with Plugins

Mynorel's Extension system allows you to add or override services via plugins (side stories). Register your extension in `config/extensions.php` and implement new services, routes, or logic as needed. See `/src/Mynorel/Extensions/README.md` for details.

Services handles business logic, the real work horse behind, `Author::can()`,`Chronicle::note()`,`Theme::palette()`, etc. Modular Separation, keeps facades thin and expressive, while 
services stay focused and composable. Injectable & Extendable, future-proof for dependency injection, mocking, or plugin overrides.


## Service Layer Structure

```
src/
└── Services/
    ├── AuthorizationService.php     # Powers Author facade
    ├── ChronicleService.php         # Powers Chronicle facade
    ├── ThemeService.php             # Powers Theme facade
    ├── DirectiveCompiler.php        # Powers directive registration
    ├── PreludePipeline.php          # Powers middleware execution
```php
namespace Mynorel\Services;

class AuthorizationService
{
    protected array $permissions = [];

    public function allow(string $action, string $role): void
    {
        $this->permissions[$role][] = $action;
    }


    # Mynorel Service Layer

    Services handle business logic—the real workhorse behind facades like `Author::can()`, `Chronicle::note()`, `Theme::palette()`, etc. Modular separation keeps facades thin and expressive, while services stay focused and composable. All services are injectable, extendable, and future-proof for dependency injection, mocking, or plugin overrides.

    ## Service Layer Structure

    ```
    src/
    └── Services/
        ├── AuthorizationService.php     # Powers Author facade
        ├── ChronicleService.php         # Powers Chronicle facade
        ├── ThemeService.php             # Powers Theme facade
        ├── DirectiveCompiler.php        # Powers directive registration
        ├── PreludePipeline.php          # Powers middleware execution
        └── Contracts/
            ├── Authorizable.php
            ├── Loggable.php
            └── ThemeProvider.php
    ```

    ## Usage & Integration Examples

    ### AuthorizationService

    ```php
    use Mynorel\Services\AuthorizationService;

    $auth = new AuthorizationService();
    $auth->allow('edit-post', 'admin');
    $auth->deny('delete-post', 'editor');
    if ($auth->can('edit-post', 'admin')) {
        // ...
    }
    ```

    **Via Facade:**

    ```php
    Author::can('edit-post')->as($user); // delegates to AuthorizationService::can('edit-post', $user->role)
    ```

    ### ChronicleService

    ```php
    use Mynorel\Services\ChronicleService;

    ChronicleService::note('Something happened');
    ChronicleService::warn('Something odd happened');
    ChronicleService::chapter('A new chapter begins');
    $log = ChronicleService::all();
    ```

    **Via Facade:**

    ```php
    Chronicle::note('Something happened');
    ```

    ### ThemeService

    ```php
    use Mynorel\Services\ThemeService;

    $palette = ThemeService::palette();
    $primary = ThemeService::get('primary');
    ThemeService::registerDirectives(['dark' => fn() => ...]);
    ```

    **Via Facade:**

    ```php
    Theme::palette();
    ```

    ### DirectiveCompiler

    ```php
    use Mynorel\Services\DirectiveCompiler;

    DirectiveCompiler::compile('uppercase', fn($value) => strtoupper($value));
    DirectiveCompiler::register([
        'lowercase' => fn($value) => strtolower($value),
    ]);
    ```

    ### PreludePipeline

    ```php
    use Mynorel\Services\PreludePipeline;

    PreludePipeline::run([
        Authenticate::class,
        SetLocale::class,
    ], $context);
    ```

    ## Extending or Replacing a Service

    You can extend or replace any service for plugins or custom logic:

    ```php
    class CustomAuthorizationService extends AuthorizationService {
        // ...override methods...
    }
    ```

    ## Integration

    - Use services directly in flows, layouts, directives, CLI, or via facades.
    - All services are ready for dependency injection and extension.
    - Myneral templates can call services via custom directives or context.
    - Example: Use AuthorizationService in a @can directive, or ThemeService in a layout.

    ---

    *Mynorel Services are modular, composable, and ready for any business logic you need. Fully integrated with Myneral templates, flows, and layouts.*