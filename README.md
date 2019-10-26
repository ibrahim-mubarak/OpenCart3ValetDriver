# OpenCart3ValetDriver
Valet Driver for OpenCart 3

## Installation
Copy the OpenCart3ValetDriver to your Custom Valet Drivers Directory
- For Mac OS: `~/.config/valet/Drivers`
- For Linux: `~/.valet/Drivers`

In your project add a `.oc3-valet.json` file with the following contents

```json
{
	"root": "/public"
}
```

The `root` Key  is the Web root of your OpenCart Installation
