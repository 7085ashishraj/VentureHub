const fs = require('fs');
const path = require('path');

const viewsDir = path.join(__dirname, 'resources', 'views');

const mappings = [
    { regex: /(?<!dark:)bg-zinc-950/g, replacement: 'bg-zinc-100 dark:bg-zinc-950' },
    { regex: /(?<!dark:)bg-zinc-900/g, replacement: 'bg-white dark:bg-zinc-900' },
    { regex: /(?<!dark:)bg-zinc-800/g, replacement: 'bg-zinc-200 dark:bg-zinc-800' },
    { regex: /(?<!dark:)bg-slate-900/g, replacement: 'bg-zinc-100 dark:bg-slate-900' },
    { regex: /(?<!dark:)bg-slate-800/g, replacement: 'bg-white dark:bg-slate-800' },
    
    // Text colors
    { regex: /(?<!dark:)text-white/g, replacement: 'text-zinc-950 dark:text-white' },
    { regex: /(?<!dark:)text-zinc-200/g, replacement: 'text-zinc-800 dark:text-zinc-200' },
    { regex: /(?<!dark:)text-zinc-300/g, replacement: 'text-zinc-700 dark:text-zinc-300' },
    { regex: /(?<!dark:)text-zinc-400/g, replacement: 'text-zinc-600 dark:text-zinc-400' },
    { regex: /(?<!dark:)text-slate-200/g, replacement: 'text-zinc-900 dark:text-slate-200' },
    { regex: /(?<!dark:)text-slate-300/g, replacement: 'text-zinc-800 dark:text-slate-300' },
    { regex: /(?<!dark:)text-slate-400/g, replacement: 'text-zinc-600 dark:text-slate-400' },

    // Borders
    { regex: /(?<!dark:)border-zinc-800/g, replacement: 'border-zinc-200 dark:border-zinc-800' },
    { regex: /(?<!dark:)border-zinc-700/g, replacement: 'border-zinc-300 dark:border-zinc-700' },
    { regex: /(?<!dark:)border-slate-700/g, replacement: 'border-zinc-300 dark:border-slate-700' }
];

function processDirectory(directory) {
    const files = fs.readdirSync(directory);

    for (const file of files) {
        const fullPath = path.join(directory, file);
        const stat = fs.statSync(fullPath);

        if (stat.isDirectory()) {
            processDirectory(fullPath);
        } else if (fullPath.endsWith('.blade.php')) {
            let content = fs.readFileSync(fullPath, 'utf8');
            let originalContent = content;

            for (const mapping of mappings) {
                content = content.replace(mapping.regex, mapping.replacement);
            }

            if (content !== originalContent) {
                fs.writeFileSync(fullPath, content, 'utf8');
                console.log(`Updated: ${fullPath}`);
            }
        }
    }
}

processDirectory(viewsDir);
console.log('Theme refactoring completed successfully.');
