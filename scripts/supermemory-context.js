#!/usr/bin/env node
/**
 * Supermemory Context Manager for FixCity Project
 * 
 * This script indexes project documentation, architecture decisions,
 * and development context into Supermemory for AI agent collaboration.
 * 
 * Usage:
 *   node scripts/supermemory-context.js index     # Index all docs
 *   node scripts/supermemory-context.js query "CSS parity strategy"
 *   node scripts/supermemory-context.js status    # Check indexed docs
 *   node scripts/supermemory-context.js clear     # Clear all memories
 */

import { Supermemory } from 'supermemory';
import { readFileSync, existsSync, readdirSync, statSync } from 'fs';
import { join, relative } from 'path';
import { fileURLToPath } from 'url';
import { dirname } from 'path';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

// Configuration
const CONTAINER_TAG = 'fixcity_project';
const PROJECT_ROOT = join(__dirname, '..', '..', '..');

// Initialize Supermemory client
const client = new Supermemory({
  apiKey: process.env.SUPERMEMORY_API_KEY
});

if (!process.env.SUPERMEMORY_API_KEY) {
  console.error('❌ SUPERMEMORY_API_KEY not set in environment');
  process.exit(1);
}

// Documentation paths to index
const DOC_PATHS = [
  { path: 'docs', tag: 'project_docs', description: 'Project-wide documentation' },
  { path: 'laravel/Themes/Sixteen/docs', tag: 'theme_docs', description: 'Sixteen theme documentation' },
  { path: '.planning', tag: 'planning', description: 'Planning and architecture decisions' },
  { path: 'bashscripts/docs', tag: 'scripts_docs', description: 'Bash scripts documentation' },
];

/**
 * Read all markdown files from a directory recursively
 */
function readMarkdownFiles(basePath) {
  const files = [];
  
  if (!existsSync(basePath)) {
    console.warn(`⚠️  Path not found: ${basePath}`);
    return files;
  }

  function scanDir(dir) {
    const entries = readdirSync(dir, { withFileTypes: true });
    
    for (const entry of entries) {
      const fullPath = join(dir, entry.name);
      
      if (entry.isDirectory()) {
        // Skip node_modules, .git, vendor
        if (!['node_modules', '.git', 'vendor', '__pycache__'].includes(entry.name)) {
          scanDir(fullPath);
        }
      } else if (entry.name.endsWith('.md')) {
        try {
          const content = readFileSync(fullPath, 'utf-8');
          const relPath = relative(PROJECT_ROOT, fullPath);
          files.push({
            path: relPath,
            content,
            size: content.length
          });
        } catch (err) {
          console.warn(`⚠️  Could not read ${fullPath}: ${err.message}`);
        }
      }
    }
  }

  scanDir(basePath);
  return files;
}

/**
 * Index all documentation into Supermemory
 */
async function indexAllDocs() {
  console.log('🚀 Starting Supermemory indexing for FixCity project...\n');
  
  let totalIndexed = 0;
  let totalSkipped = 0;

  for (const docPath of DOC_PATHS) {
    const fullPath = join(PROJECT_ROOT, docPath.path);
    console.log(`📁 Indexing: ${docPath.path} (${docPath.description})`);
    
    const files = readMarkdownFiles(fullPath);
    console.log(`   Found ${files.length} markdown files`);

    for (const file of files) {
      try {
        // Skip very large files (>100KB) - split them instead
        if (file.size > 100000) {
          console.log(`   ⏭️  Skipping large file: ${file.path} (${(file.size/1024).toFixed(1)}KB)`);
          totalSkipped++;
          continue;
        }

        // Sanitize customId: only alphanumeric, hyphens, underscores
        const sanitizedId = `doc_${file.path.replace(/[/\\ .]/g, '_').replace(/[^a-zA-Z0-9_-]/g, '')}`;
        
        await client.add({
          content: `# ${file.path}\n\n${file.content}`,
          containerTag: `${CONTAINER_TAG}_${docPath.tag}`,
          entityContext: `FixCity project documentation - ${docPath.description}`,
          customId: sanitizedId,
          metadata: {
            type: 'documentation',
            category: docPath.tag,
            path: file.path,
            size: file.size,
            indexedAt: new Date().toISOString()
          }
        });

        totalIndexed++;
        process.stdout.write(`   ✅ ${file.path}\n`);
      } catch (err) {
        console.error(`   ❌ Error indexing ${file.path}: ${err.message}`);
      }
    }
    
    console.log('');
  }

  console.log('\n📊 Indexing Summary:');
  console.log(`   ✅ Total indexed: ${totalIndexed}`);
  console.log(`   ⏭️  Total skipped: ${totalSkipped}`);
  console.log(`   🏷️  Container tag: ${CONTAINER_TAG}`);
  console.log('\n✨ Indexing complete! AI agents can now query this context.\n');
}

/**
 * Query Supermemory for project context
 */
async function queryContext(queryText) {
  console.log(`🔍 Querying Supermemory: "${queryText}"\n`);

  try {
    const response = await client.search.memories({
      q: queryText,
      containerTag: CONTAINER_TAG,
      searchMode: 'hybrid',
      threshold: 0.3,
      limit: 10
    });

    if (response.results.length === 0) {
      console.log('❌ No relevant memories found.');
      return;
    }

    console.log(`📊 Found ${response.total} relevant documents (showing top ${response.results.length}):\n`);

    response.results.forEach((result, index) => {
      console.log(`${index + 1}. [${result.metadata?.category || 'unknown'}] ${result.metadata?.path || 'Unknown'}`);
      console.log(`   Similarity: ${(result.similarity * 100).toFixed(1)}%`);
      
      // Show preview of content
      const preview = (result.memory || result.chunk || '').substring(0, 200);
      console.log(`   Preview: ${preview}...`);
      console.log('');
    });

  } catch (err) {
    console.error(`❌ Query failed: ${err.message}`);
    process.exit(1);
  }
}

/**
 * Show status of indexed documents
 */
async function showStatus() {
  console.log('📊 Supermemory Status for FixCity Project\n');

  for (const docPath of DOC_PATHS) {
    const containerTag = `${CONTAINER_TAG}_${docPath.tag}`;
    console.log(`📁 ${docPath.path} (${docPath.description})`);
    console.log(`   Tag: ${containerTag}`);

    try {
      const docs = await client.documents.list({
        containerTag,
        limit: 5
      });

      console.log(`   Documents: ${docs.total}`);
      
      if (docs.documents.length > 0) {
        console.log('   Recent:');
        docs.documents.slice(0, 3).forEach(doc => {
          console.log(`     - ${doc.metadata?.path || doc.id} [${doc.status}]`);
        });
      }
      console.log('');
    } catch (err) {
      console.log(`   ⚠️  Could not fetch status: ${err.message}\n`);
    }
  }
}

/**
 * Clear all memories for this project
 */
async function clearAll() {
  console.log('⚠️  Clearing all Supermemory memories for FixCity project...\n');

  for (const docPath of DOC_PATHS) {
    const containerTag = `${CONTAINER_TAG}_${docPath.tag}`;
    console.log(`🗑️  Clearing: ${containerTag}`);

    try {
      const docs = await client.documents.list({
        containerTag,
        limit: 100
      });

      for (const doc of docs.documents) {
        await client.documents.delete({ docId: doc.id });
        process.stdout.write('.');
      }
      
      console.log(` ✅ Cleared ${docs.documents.length} documents\n`);
    } catch (err) {
      console.log(`   ⚠️  Error: ${err.message}\n`);
    }
  }

  console.log('✨ All memories cleared.\n');
}

// Main execution
const command = process.argv[2] || 'help';

switch (command) {
  case 'index':
    await indexAllDocs();
    break;
  
  case 'query':
  case 'search':
    const query = process.argv.slice(3).join(' ') || 'CSS parity strategy';
    await queryContext(query);
    break;
  
  case 'status':
    await showStatus();
    break;
  
  case 'clear':
    await clearAll();
    break;
  
  default:
    console.log(`
🧠 Supermemory Context Manager for FixCity

Usage:
  node scripts/supermemory-context.js index     # Index all project docs
  node scripts/supermemory-context.js query "your question"  # Search context
  node scripts/supermemory-context.js status    # Show indexed docs status
  node scripts/supermemory-context.js clear     # Clear all memories

Examples:
  node scripts/supermemory-context.js index
  node scripts/supermemory-context.js query "CSS parity strategies"
  node scripts/supermemory-context.js query "Design Comuni HTML structure"
  node scripts/supermemory-context.js status

Container Tag: ${CONTAINER_TAG}
    `);
}
