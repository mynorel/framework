
# Mynorel Search

Mynorel Search provides full-text and structured search for your narrative and resources. Integrated with config, services, and the extension system, and logs actions via Chronicle.

## Features
- Full-text and structured search (see SearchService)
- Extensible indexing backends
- Logging via Chronicle

## Philosophy
Search is discovery in the narrative. All logic is modular, extensible, and narrative-centric.

## Security & Robustness
- Only authenticated users can search
- All search actions are logged via Chronicle
- Input is sanitized and validated

## Usage Example
```php
use Mynorel\Search\SearchService;

try {
	$results = SearchService::search('query');
} catch (Exception $e) {
	// Handle unauthorized or error
}
```
