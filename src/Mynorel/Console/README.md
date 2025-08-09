# Mynorel Console Layer

The Console is Mynorel’s command chamber—a narrative interface for invoking flows, installing modules, and exploring the framework’s philosophy. It transforms commands into guided experiences, making the CLI feel like a mentor, not a machine.

## Expressive Commands


```bash
myne install
myne philosophy
myne chapter:list
myne plotline:map
myne manifest
myne list
myne help
```

## Narrative Output

```bash
🌱 Mynorel has taken root.
→ Core, CLI, and Myneral templating are now alive.
→ Theme: myneral-dark
→ Begin your journey: myne guide

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