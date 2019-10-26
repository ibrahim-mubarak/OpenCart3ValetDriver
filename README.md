# OpenCart3ValetDriver
Valet Driver for OpenCart 3

## Installation

### 1. Copy Driver
Copy the `OpenCart3ValetDriver.php` to your Custom Valet Drivers Directory
- For Mac OS: `~/.config/valet/Drivers`
- For Linux: `~/.valet/Drivers`

### 2. Setup Project
Copy `.oc3-valet.json` to the root of your project directory.

```json
{
	"root": "/public"
}
```

Point the `root` key in the json to where your `index.php` exists in your OpenCart Installation.
