/**
 * Initialize SuperMemory with FixCity Sixteen Theme project context
 * Run: node .supermemory/init-memories.js
 */
import { Supermemory } from 'supermemory';
import { readFileSync } from 'fs';
import { fileURLToPath } from 'url';
import { dirname, join } from 'path';

const __dirname = dirname(fileURLToPath(import.meta.url));
const config = JSON.parse(readFileSync(join(__dirname, 'config.json'), 'utf8'));

const client = new Supermemory({
  apiKey: config.apiKey
});

const TAG = 'fixcity-sixteen';

// Project context memories
const projectMemories = [
  {
    content: "FixCity is a citizen reporting platform for urban issue management. Citizens report problems (potholes, broken lights, etc.), administrators manage them through Filament admin panels.",
    metadata: { type: "project-overview", category: "architecture" }
  },
  {
    content: "Tech stack: Laravel 12.24.0, PHP 8.3.20, SQLite database. Backoffice: Filament 3.x + Laraxot. Frontoffice: Folio + Volt + Livewire 3.x. Modular monolith using Nwidart/Laravel-Modules + Laraxot extensions.",
    metadata: { type: "tech-stack", category: "architecture" }
  },
  {
    content: "Theme system: Sixteen is the active theme. Located at laravel/Themes/Sixteen/. Build process: npm run build then npm run copy to deploy assets to public_html/themes/Sixteen/. Uses Tailwind CSS v4, Alpine.js, Vite.",
    metadata: { type: "theme-system", category: "frontend" }
  },
  {
    content: "CRITICAL RULES: 1) HTML structural parity with Design Comuni reference (https://italia.github.io/design-comuni-pagine-statiche/) is essential - same tags, same Bootstrap classes, same data-element attributes. 2) NO Bootstrap runtime - use Tailwind @apply in style-apply.css and Alpine.js for interactivity. 3) Translation format: namespace::context.collection.element.type (5 levels). 4) CSS/JS changes require npm run build && npm run copy from Themes/Sixteen directory.",
    metadata: { type: "critical-rules", category: "development" }
  },
  {
    content: "CSS/JS Phase workflow: HTML parity must be >80% before CSS/JS work. Only modify CSS/JS to match visual reference. Take screenshots comparing local vs reference. Study Bootstrap Italia reference at github.com/italia/design-comuni-pagine-statiche. Maintain HTML parity while improving visual match.",
    metadata: { type: "workflow", category: "development" }
  },
  {
    content: "Key modules: Xot (framework base), Fixcity (core ticket system), User (auth/profiles), Cms (content management, JSON storage), Geo (geographic data), Notify (notifications), UI (shared components), Lang (multi-language). All modules use XotBase classes - models extend XotBaseModel, providers extend XotBaseServiceProvider.",
    metadata: { type: "modules", category: "architecture" }
  },
  {
    content: "Design Comuni replication: 38 static pages to replicate. Block analysis identified 47 reusable components. Tier 1 components: cmp-base, cmp-breadcrumbs, cmp-contacts, cmp-rating, cmp-hero, cmp-card, cmp-button. Single [slug].blade.php handles all pages dynamically via JSON content blocks.",
    metadata: { type: "design-comuni", category: "frontend" }
  },
  {
    content: "Documentation strategy: DRY + KISS. docs/ folder for project-wide, laravel/Modules/*/docs/ for module-specific, laravel/Themes/*/docs/ for theme-specific. No duplicates - use cross-reference links. Max 3 levels of nesting. Bidirectional links (min 3 cross-references per doc).",
    metadata: { type: "documentation", category: "process" }
  },
  {
    content: "Development workflow: Frontend changes in Themes/Sixteen/. CSS/JS changes require npm run build && npm run copy. New pages use php artisan folio:page. Admin features create Filament Resources. Interactivity uses Livewire Volt. Models extend XotBaseModel. Testing uses Pest. Documentation updated with every change.",
    metadata: { type: "workflow", category: "development" }
  },
  {
    content: "BMAD + GSD methodology: BMAD for planning (PRD, Architecture, UX Design, Epics, Sprint Planning). GSD for execution (atomic commits, wave-based parallelization, verification). Ralph Loop for autonomous execution. All phases must pass verification before proceeding.",
    metadata: { type: "methodology", category: "process" }
  }
];

async function init() {
  console.log(' Initializing SuperMemory for FixCity Sixteen Theme...\n');

  for (const memory of projectMemories) {
    try {
      await client.add({
        content: memory.content,
        containerTag: TAG,
        metadata: memory.metadata
      });
      console.log(`✅ Added: ${memory.metadata.type} (${memory.metadata.category})`);
    } catch (error) {
      console.log(`❌ Failed: ${memory.metadata.type} - ${error.message}`);
    }
  }

  console.log('\n🔍 Testing search...');
  try {
    const results = await client.search.memories({
      q: "tech stack laravel",
      containerTag: TAG,
      limit: 3,
      threshold: 0.3
    });
    console.log(`Found ${results.results?.length || 0} results for "tech stack laravel"`);
  } catch (error) {
    console.log(`Search error: ${error.message}`);
  }

  console.log('\n📊 Getting profile...');
  try {
    const profile = await client.profile({
      containerTag: TAG,
      q: "project overview"
    });
    console.log(`Static facts: ${profile.profile?.static?.length || 0}`);
    console.log(`Dynamic facts: ${profile.profile?.dynamic?.length || 0}`);
  } catch (error) {
    console.log(`Profile error: ${error.message}`);
  }

  console.log('\n✅ SuperMemory initialization complete!');
}

init().catch(console.error);
