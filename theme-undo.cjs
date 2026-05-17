const fs = require('fs');
const path = require('path');

const viewsDir = path.join(__dirname, 'resources', 'views');
const excludeDirs = ['layouts'];
const excludeFiles = ['welcome.blade.php'];

const mappings = [
    // We do NOT revert bg-zinc-950 -> bg-zinc-100 dark:bg-zinc-950 because that's the page background in many places
    
    // Backgrounds (Cards)
    { regex: /bg-white dark:bg-zinc-900\/50/g, replacement: 'bg-zinc-900/90 dark:bg-zinc-900/50' }, // specific handle for opacity
    { regex: /bg-white dark:bg-zinc-900/g, replacement: 'bg-zinc-900' },
    { regex: /bg-zinc-200 dark:bg-zinc-800/g, replacement: 'bg-zinc-800' },
    { regex: /bg-zinc-100 dark:bg-slate-900/g, replacement: 'bg-slate-900' },
    { regex: /bg-white dark:bg-slate-800/g, replacement: 'bg-slate-800' },
    
    // Text colors
    { regex: /text-zinc-950 dark:text-white/g, replacement: 'text-white' },
    { regex: /text-zinc-800 dark:text-zinc-200/g, replacement: 'text-zinc-200' },
    { regex: /text-zinc-700 dark:text-zinc-300/g, replacement: 'text-zinc-300' },
    { regex: /text-zinc-600 dark:text-zinc-400/g, replacement: 'text-zinc-400' },
    { regex: /text-zinc-900 dark:text-slate-200/g, replacement: 'text-slate-200' },
    { regex: /text-zinc-800 dark:text-slate-300/g, replacement: 'text-slate-300' },
    { regex: /text-zinc-600 dark:text-slate-400/g, replacement: 'text-slate-400' },

    // Borders
    { regex: /border-zinc-200 dark:border-zinc-800/g, replacement: 'border-zinc-800' },
    { regex: /border-zinc-300 dark:border-zinc-700/g, replacement: 'border-zinc-700' },
    { regex: /border-zinc-300 dark:border-slate-700/g, replacement: 'border-slate-700' }
];

function processDirectory(directory) {
    const files = fs.readdirSync(directory);

    for (const file of files) {
        const fullPath = path.join(directory, file);
        const stat = fs.statSync(fullPath);

        if (stat.isDirectory()) {
            if (!excludeDirs.includes(file)) {
                processDirectory(fullPath);
            }
        } else if (fullPath.endsWith('.blade.php')) {
            if (excludeFiles.includes(file)) {
                continue;
            }

            let content = fs.readFileSync(fullPath, 'utf8');
            let originalContent = content;

            for (const mapping of mappings) {
                content = content.replace(mapping.regex, mapping.replacement);
            }

            // Also fix the headers that were left as text-zinc-100 on off-white backgrounds
            content = content.replace(/text-zinc-100 leading-tight/g, 'text-zinc-900 dark:text-zinc-100 leading-tight');
            content = content.replace(/text-white leading-tight/g, 'text-zinc-900 dark:text-white leading-tight');

            if (content !== originalContent) {
                fs.writeFileSync(fullPath, content, 'utf8');
                console.log(`Reverted: ${fullPath}`);
            }
        }
    }
}

processDirectory(viewsDir);
console.log('Theme undo completed successfully.');
