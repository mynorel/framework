# MemoryPalace (Cache Layer)

MemoryPalace is Mynorel’s narrative cache. Store, recall, and forget fragments of your story—speed up queries, pages, and flows with poetic, expressive caching.


## Usage
## CLI Usage

Interact with the cache directly from the Mynorel CLI:

```bash
php myne memorypalace inscribe hero Alice
php myne memorypalace recall hero
php myne memorypalace forget hero
php myne memorypalace clear
```

Actions:
- `inscribe {key} {value}`: Store a value
- `recall {key}`: Retrieve a value
- `forget {key}`: Remove a value
- `clear`: Clear all cached fragments

```php
use Mynorel\MemoryPalace\MemoryPalace;

// Store a value (inscribe)
MemoryPalace::inscribe('hero', 'Alice', 60); // 60 seconds

// Retrieve a value (recall)
$name = MemoryPalace::recall('hero');

// Forget a value
MemoryPalace::forget('hero');

// Clear all cached fragments
MemoryPalace::clear();
```

## Philosophy
- The MemoryPalace is a library of remembered fragments.
- Caching is poetic, modular, and ready for extension.

---
*"Every story needs a memory. Every app needs a palace."*
