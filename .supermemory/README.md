# SuperMemory Configuration

**Service**: SuperMemory AI - Persistent Memory Infrastructure for AI Agents  
**API Key**: `sm_BzH3Cugxk1hMDm5V1EHC2N_Jr9NfJdUqxlnPe21yb9q7FtbYMevTsoPtKZJEfBqdP4i81z6aJA34SF32Gx3PUa9`  
**Container Tag**: `fixcity-sixteen`  
**Last Updated**: 2026-04-09

## Configuration Files

```
.supermemory/
├── config.json          # API key, tag, project settings
├── team.json           # Team configuration (committed)
└── init-memories.js    # Project context initialization script
```

## Environment Variables

- `SUPERMEMORY_API_KEY`: Set in `.env` (project root)
- `SUPERMEMORY_TAG`: `fixcity-sixteen` (default container tag)

## Usage

### Initialize Memories (One-time setup)

```bash
cd laravel/Themes/Sixteen
node .supermemory/init-memories.js
```

### Search Memories

```bash
node -e "
const { Supermemory } = require('supermemory');
const client = new Supermemory({ apiKey: process.env.SUPERMEMORY_API_KEY });

client.search.memories({
  q: 'your query here',
  containerTag: 'fixcity-sixteen',
  limit: 5,
  threshold: 0.3
}).then(r => console.log(JSON.stringify(r, null, 2)));
"
```

### Add New Memory

```bash
node -e "
const { Supermemory } = require('supermemory');
const client = new Supermemory({ apiKey: process.env.SUPERMEMORY_API_KEY });

client.add({
  content: 'Your memory content here',
  containerTag: 'fixcity-sixteen',
  metadata: { type: 'your-type', category: 'your-category' }
}).then(() => console.log('Memory added'));
"
```

### Get Profile

```bash
node -e "
const { Supermemory } = require('supermemory');
const client = new Supermemory({ apiKey: process.env.SUPERMEMORY_API_KEY });

client.profile({
  containerTag: 'fixcity-sixteen',
  q: 'project overview'
}).then(r => console.log(JSON.stringify(r, null, 2)));
"
```

## Project Memories

The following memories have been initialized:

| Type | Category | Description |
|------|----------|-------------|
| project-overview | architecture | FixCity platform overview |
| tech-stack | architecture | Laravel, PHP, SQLite, Filament, Livewire |
| theme-system | frontend | Sixteen theme build process |
| critical-rules | development | HTML parity, Tailwind @apply, translations |
| workflow | development | CSS/JS phase workflow |
| modules | architecture | Xot, Fixcity, User, Cms, Geo modules |
| design-comuni | frontend | 38 pages, 47 components, block analysis |
| documentation | process | DRY + KISS documentation strategy |
| workflow | development | Development workflow |
| methodology | process | BMAD + GSD + Ralph Loop |

## Integration with AI Agents

SuperMemory is used by AI agents to:
1. **Retrieve context** before working on tasks (profile + search)
2. **Store new memories** after completing work
3. **Maintain project knowledge** across sessions

### Agent Workflow Pattern

```
1. Agent starts → client.profile({ q: "relevant context" })
2. Agent works → Uses retrieved context
3. Agent finishes → client.add({ content: "what was done" })
```

## Links

- [SuperMemory Console](https://console.supermemory.ai)
- [SuperMemory Docs](https://supermemory.ai/docs)
- [SDK Documentation](https://www.npmjs.com/package/supermemory)
- [GitHub](https://github.com/supermemoryai/supermemory)
