# Mynorel API Reference

## Table of Contents
- [Flow](#Flow)
- [FlowManager](#FlowManager)
- [Console](#Console)
- [Epic](#Epic)
- [ThemeSkins](#ThemeSkins)
- [Scriptorium](#Scriptorium)
- [PageTurnerCommand](#PageTurnerCommand)
- [InstallCommand](#InstallCommand)
- [PhilosophyCommand](#PhilosophyCommand)
- [ChapterListCommand](#ChapterListCommand)
- [PlotlineCommand](#PlotlineCommand)
- [LogCommand](#LogCommand)
- [JournalCommand](#JournalCommand)
- [ManifestCommand](#ManifestCommand)
- [ListCommand](#ListCommand)
- [HelpCommand](#HelpCommand)
- [FlowValidateCommand](#FlowValidateCommand)
- [TestCommand](#TestCommand)
- [NarrativeConsoleCommand](#NarrativeConsoleCommand)
- [EpicCommand](#EpicCommand)
- [ThemeSkinCommand](#ThemeSkinCommand)
- [MemoryPalaceCommand](#MemoryPalaceCommand)
- [HeraldCommand](#HeraldCommand)
- [DocsGenerateCommand](#DocsGenerateCommand)
- [CommandInterface](#CommandInterface)

## Flow (Classes)

Flow: Defines a sequence of directives for a narrative flow.

**Namespace:** `Mynorel\Myneral\Flows`

### Properties
- `sequence`: `array`

### Public Methods
- ```php
__construct(array $sequence)
```

- ```php
sequence(): array
```


---

## FlowManager (Classes)

**Namespace:** `Mynorel\Myneral\Flows`

### Properties
- `flows`: `array`

### Public Methods
- ```php
static register(string $name, Mynorel\Myneral\Flows\Flow $flow): void
```

- ```php
static get(string $name): ?Mynorel\Myneral\Flows\Flow
```

- ```php
static validate(string $name): array
```
Validate a flow: check that all directives in the flow are registered in Myneral.
@param string $name
@return array List of missing directives (empty if valid)


---

## Console (Classes)

Console: Mynorel's command chamber and CLI kernel.
Registers and executes commands, providing a narrative CLI experience.

**Namespace:** `Mynorel\Console`

### Properties
- `commands`: `array`

### Public Methods
- ```php
__construct()
```

- ```php
register(Mynorel\Console\Contracts\CommandInterface $command): void
```
Register a command.
@param CommandInterface $command

- ```php
run(string $name, array $input = array (
)): int
```
Run a command by name.
@param string $name
@param array $input
@return int Exit code

- ```php
list(): array
```
List all registered commands.
@return array

### Protected Methods
- ```php
registerDefaults(): void
```
Register default Mynorel commands.


---

## Epic (Classes)

Epic: Narrative job/task system for Mynorel.
Jobs are "epics" and background tasks are "side quests."

**Namespace:** `Mynorel\Epic`

### Properties
- `epics`: `array`

### Public Methods
- ```php
static register(string $name, callable $callback): void
```
Register a new epic (job/task).

- ```php
static list(): array
```
List all registered epics.

- ```php
static start(string $name, $args): void
```
Start an epic (job/task).


---

## ThemeSkins (Classes)

ThemeSkins: Pluggable theming system for Mynorel CLI/web output.
Skins are narrative themes for your app’s presentation.

**Namespace:** `Mynorel\ThemeSkins`

### Properties
- `skins`: `array`
- `active`: `?string`

### Public Methods
- ```php
static register(string $name, callable $formatter): void
```
Register a new skin.

- ```php
static list(): array
```
List all registered skins.

- ```php
static active(): ?string
```
Get the active skin name.

- ```php
static activate(string $name): void
```
Set the active skin.

- ```php
static format(string $text): string
```
Format output using the active skin.


---

## Scriptorium (Classes)

Scriptorium: Mynorel's narrative service container.
Casts, stores, and retrieves story elements (services, characters, props).

**Namespace:** `Mynorel\Scriptorium`

### Properties
- `bindings`: `array`
- `singletons`: `array`
- `instances`: `array`

### Public Methods
- ```php
static bind(string $name, callable $resolver): void
```
Bind a service (transient).

- ```php
static singleton(string $name, callable $resolver): void
```
Bind a singleton (shared instance).

- ```php
static make(string $name, $args)
```
Resolve a service or singleton.

- ```php
static has(string $name): bool
```
Check if a binding exists.

- ```php
static clear(): void
```
Clear all bindings and instances (for testing).


---

## PageTurnerCommand (Classes)

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
name(): string
```

- ```php
description(): string
```

- ```php
execute(array $input, array $output): int
```


---

## InstallCommand (Classes)

InstallCommand: Installs Mynorel core and modules.

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
execute(array $input, array $output): int
```

- ```php
name(): string
```

- ```php
description(): string
```


---

## PhilosophyCommand (Classes)

PhilosophyCommand: Shares Mynorel's philosophy and narrative approach.

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
execute(array $input, array $output): int
```

- ```php
name(): string
```

- ```php
description(): string
```


---

## ChapterListCommand (Classes)

ChapterListCommand: Lists all chapters (routes) in the narrative.

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
execute(array $input, array $output): int
```

- ```php
name(): string
```

- ```php
description(): string
```


---

## PlotlineCommand (Classes)

PlotlineCommand: Maps out the plotlines (models/ORM) in the application.

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
execute(array $input, array $output): int
```

- ```php
name(): string
```

- ```php
description(): string
```


---

## LogCommand (Classes)

LogCommand: Outputs the narrative log (Chronicle) in poetic style.

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
execute(array $input, array $output): int
```

- ```php
name(): string
```

- ```php
description(): string
```


---

## JournalCommand (Classes)

JournalCommand: Outputs a developer journal from the Chronicle log.

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
execute(array $input, array $output): int
```

- ```php
name(): string
```

- ```php
description(): string
```


---

## ManifestCommand (Classes)

ManifestCommand: Introspect framework modules and meta-information.

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
execute(array $input, array $output): int
```

- ```php
name(): string
```

- ```php
description(): string
```


---

## ListCommand (Classes)

ListCommand: Lists all available CLI commands.

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
execute(array $input, array $output): int
```

- ```php
name(): string
```

- ```php
description(): string
```


---

## HelpCommand (Classes)

HelpCommand: Shows help for all CLI commands.

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
execute(array $input, array $output): int
```

- ```php
name(): string
```

- ```php
description(): string
```


---

## FlowValidateCommand (Classes)

FlowValidateCommand: Validates a named flow and reports missing directives.

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
execute(array $input, array $output): int
```

- ```php
name(): string
```

- ```php
description(): string
```


---

## TestCommand (Classes)

TestCommand: Runs the Mynorel test suite with narrative output.

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
execute(array $input, array $output): int
```

- ```php
name(): string
```

- ```php
description(): string
```


---

## NarrativeConsoleCommand (Classes)

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
name(): string
```

- ```php
description(): string
```

- ```php
execute(array $input, array $output): int
```


---

## EpicCommand (Classes)

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
name(): string
```

- ```php
description(): string
```

- ```php
execute(array $input, array $output): int
```


---

## ThemeSkinCommand (Classes)

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
name(): string
```

- ```php
description(): string
```

- ```php
execute(array $input, array $output): int
```


---

## MemoryPalaceCommand (Classes)

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
name(): string
```

- ```php
description(): string
```

- ```php
execute(array $input, array $output): int
```
Execute the command.
@param array $input
@param array $output
@return int


---

## HeraldCommand (Classes)

HeraldCommand: CLI for real-time narrative (WebSocket) operations.

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
name(): string
```

- ```php
description(): string
```

- ```php
execute(array $input, array $output): int
```


---

## DocsGenerateCommand (Classes)

**Namespace:** `Mynorel\Console\Commands`

### Public Methods
- ```php
name(): string
```

- ```php
description(): string
```

- ```php
execute(array $input, array $output): int
```


---

## CommandInterface (Interfaces)

CommandInterface: Contract for all Mynorel console commands.

**Namespace:** `Mynorel\Console\Contracts`

### Public Methods
- ```php
execute(array $input, array $output): int
```
Execute the command.
@param array $input
@param array $output
@return int Exit code

- ```php
name(): string
```
Get the command's name (e.g., 'install', 'chapter:list').
@return string

- ```php
description(): string
```
Get a short description of the command.
@return string

