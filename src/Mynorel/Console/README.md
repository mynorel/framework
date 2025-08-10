## Interactive CLI

Mynorel Console supports narrative prompts and menus:

```php
use Mynorel\Console\Support\InteractivePrompt;
$name = InteractivePrompt::ask('What is your character name?', 'Alice');
$choice = InteractivePrompt::menu('Choose your path:', ['Hero', 'Villain', 'Guide']);
```

## Extension Command API

Extensions can register their own CLI commands by implementing `CommandInterface` and registering with the Console:

```php
$console->register(new \Your\Extension\Commands\CustomCommand());
```
# Mynorel Console Layer

The Console is Mynorel’s command chamber—a narrative interface for invoking flows, installing modules, and exploring the framework’s philosophy. It transforms commands into guided experiences, making the CLI feel like a mentor, not a machine.

## Expressive Commands


```bash
mynorel install
mynorel philosophy
mynorel chapter:list
mynorel plotline:map
mynorel manifest
mynorel list
mynorel help
```

## Narrative Output

```bash
🌱 Mynorel has taken root.
→ Core, CLI, and Myneral templating are now alive.
→ Theme: myneral-dark
→ Begin your journey: mynorel guide

→ Chapters in your story:
 - home
 - profile
 - publish

→ Plotlines in your story:
 - PostPlot
 - UserPlot
 - CommentPlot
```


## Dynamic Integration

- `chapter:list` fetches chapters from Narrative in real time
- `plotline:map` fetches plotlines/models from Plotline ORM
- `manifest` shows all modules and philosophy using Manifest
- `list` and `help` show all available CLI commands
- Output is stylized and poetic via `StylizedPrinter`, with colorization via `SyntaxColorizer`

### Structure 

- Commands/: Individual commands
- Output/: Stylized printing and formatting
- Services/: Internal helpers like framework detection
- Contracts/: Interfaces for command structure

## Extending

- Add new commands in `Commands/` implementing `CommandInterface`
- Use `StylizedPrinter` for narrative output
- Integrate with other features (e.g., Chronicle, Author) for richer CLI experiences