
# Plugin Marketplace

Discover, install, and manage Mynorel plugins from a central registry.

## Usage

List available plugins:
```
php myne marketplace
```

Install a plugin:
```
php myne marketplace install <plugin>
```


## Features
- List available plugins with version, dependencies, and status
- Install plugins with feedback, dependency checks, and signature validation
- Secure plugin install: input sanitization, signature check, and (future) sandboxing
- Handles dependencies and version constraints
- (Planned) Remote plugin registry and plugin sandboxing
- Extensible for new plugin types and security policies

---
*"Every plugin is a new chapter in your app's story."*
