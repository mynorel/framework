# Extensions (Side Stories)

Mynorel Extensions are "side stories"—modular plugins that expand your application's narrative. Register and boot extensions at runtime to add new features, integrations, or custom flows, all while keeping your core story clean and expressive.

## How to Create an Extension

1. **Implement `ExtensionInterface`:**
   - Define a static `boot()` method for setup, hooks, or service registration.
2. **Register Your Extension:**
   - `Extension::register(YourExtension::class);`
3. **Boot All Extensions:**
   - `Extension::bootAll();` (now integrated into Mynorel's core lifecycle)

Extensions can add services, routes, directives, or even new narrative metaphors. They are first-class citizens in the Mynorel ecosystem.

---

*"Every great story has a side story. Let yours begin here."*
