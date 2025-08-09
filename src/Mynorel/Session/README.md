# Mynorel Session Layer

The Session layer is Mynorel's narrative state management system. It preserves fragments of the user's journey—identity, state, and flash messages—across requests, using expressive, story-driven metaphors.

- Flash message helper (Flash) for CLI, templates, and web output
- Start and manage PHP sessions in a narrative way
- Store, recall, and forget session data ("memories")
- Namespaced keys with dot notation (e.g., `Session::inscribe('cart.items.0', ...)`)
- Flash data for one-time messages ("ephemeral memories")
- Destroy sessions ("end the journey")
- Regenerate session ID for security
- ArrayAccess support (`$session['key']`)
- Custom session driver support (future)
- CSRF token generation and validation
- Remember-me (persistent login) cookies
- Session timeout helpers
- Inspect all session data and keys
- Event hooks (on start, end, inscribe, recall, forget)
- Used by Auth for persistent login



### Flash Messages (CLI, Template, Web)

```php
use Mynorel\Session\Flash;

// Set a flash message
Flash::set('success', 'Operation complete!');

// Get and remove a flash message
$msg = Flash::get('success');

// Peek at a flash message (without removing)
$peek = Flash::peek('success');

// Check if a flash message exists
if (Flash::has('success')) { /* ... */ }

// Clear all flash messages
Flash::clear();
```

```php
use Mynorel\Session\Session;

// Start a session (if not already started)
Session::start();

// Store a value (supports dot notation for namespaces)
Session::inscribe('cart.items.0', 'Book');

// Retrieve a value
$value = Session::recall('cart.items.0', 'default');

// Remove a value
Session::forget('cart.items.0');

// Flash a value (one-time)
Session::flash('notice', 'Welcome back!');

// Retrieve and remove a flashed value
$notice = Session::recallFlash('notice');

// Regenerate session ID (after login)
Session::regenerateId();

// ArrayAccess
$session = new Session();
$session['foo'] = 'bar';
echo $session['foo'];

// CSRF token
$token = Session::csrfToken();
if (Session::validateCsrfToken($_POST['csrf_token'] ?? '')) { /* ... */ }

// Remember-me cookie
Session::remember('remember_token', $token);
$token = Session::recallRemember('remember_token');
Session::forgetRemember('remember_token');

// Timeout
Session::setTimeout(3600); // 1 hour
if (Session::isExpired()) { Session::end(); }

// Inspect session
$all = Session::all();
$keys = Session::keys();

// Event hooks
Session::on('inscribe', function($key, $value) { /* ... */ });

// End the session
Session::end();
```

## Integration
- **Auth**: The Auth layer uses Session to persist user identity between requests.
- **CSRF**: Use Session's CSRF helpers in forms and request validation.
- **Remember-me**: Use Session's cookie helpers for persistent login.
- **Timeout**: Use Session's timeout helpers for auto-logout or session expiry.
- **Other Features**: Any Mynorel feature needing persistent state, flash messages, or event hooks can use Session.

## File Structure
```
src/Mynorel/Session/
├── Session.php      # Main session class
└── README.md        # This documentation
```

## Philosophy
- Sessions are "memory palaces" for the user's journey.
- Flash data is an "ephemeral memory"—lasting only until recalled.
- Ending a session is "closing the book" on a user's story.
