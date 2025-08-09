# Mynorel Chronicle Logger

Chronicle is Mynorel's narrative logging system. Errors and events are explained like story interruptions, not stack traces. Logging becomes a way to track the plot and developer journey.

## Narrative Debugging

```php
Chronicle::note('User logged in');
Chronicle::warn('Missing directive: @flow');
Chronicle::chapter('Migration started');
Chronicle::interrupt('Database connection lost');
```

## Developer Journaling

Mynorel is about developer experience. Logging can serve as a journal of decisions, CLI actions, and framework evolution.

```bash
myne journal
→ Aug 9: Installed Plotline
→ Aug 10: Created directive @echo
→ Aug 11: Theme changed to myneral-dark
```

## CLI Integration

Chronicle provides two CLI commands:

- `myne log` — Show the narrative log in poetic style
- `myne journal` — Show the developer journal (date + message)

Example output:

```bash
myne log
→ [info] A note: User logged in
→ [warn] A shadow falls: Missing directive: @flow
→ [chapter] A new chapter begins: Migration started

myne journal
→ Aug 9: User logged in
→ Aug 9: Migration started
```

## Channels & Formatters

Chronicle supports multiple output channels and poetic formatting:

- **Channels**: Memory, file, CLI, etc. (see `Channels/`)
- **Formatters**: Poetic, JSON, plain (see `Formatters/`)

By default, logs are sent to the in-memory channel and formatted poetically for CLI/dev output.

### Custom Channel Example

```php
use Mynorel\Chronicle\Writer;
Writer::addChannel(MyCustomChannel::class);
```

### Custom Formatter Example

```php
use Mynorel\Chronicle\Writer;
Writer::setFormatter(MyJsonFormatter::class);
```

## Architectural Fit

```
src/Mynorel/Chronicle/
├── Chronicle.php         # Facade
├── Writer.php            # Core logic
├── Formatters/           # Poetic, JSON, plain
├── Channels/             # File, CLI, memory
├── LogEntry.php
```

Expose via facade:

```php
Chronicle::note('Directive compiled');
Chronicle::chapter('Flow started');
Chronicle::warn('Missing layout');
Chronicle::interrupt('Critical error');
```

## Extending

- Add new channels in `Channels/` and register with `Writer::addChannel()`
- Add new formatters in `Formatters/` and set with `Writer::setFormatter()`
- Use Chronicle in all features for narrative, developer-friendly logging