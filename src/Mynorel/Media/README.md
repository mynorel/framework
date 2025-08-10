# Mynorel Media

Mynorel Media manages files, images, and other media assets as part of your narrative. Integrated with config, services, and the extension system, and logs actions via Chronicle.

## Features
- File and image upload (see MediaService)
- Media organization and serving
- Extensible storage backends
- Logging via Chronicle

## Philosophy
Media is part of the story. All logic is modular, extensible, and narrative-centric.

## Usage Example
```php
use Mynorel\Media\MediaService;

$path = MediaService::upload($_FILES['file']);
$media = MediaService::list();
```

## CLI Usage

List all media assets:

```bash
php mynorel media:list --user=alice
```
