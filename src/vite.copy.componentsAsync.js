import watch from 'watch';
import path from 'path';
import { copyFile, constants } from 'fs';
import process from 'process';


import packages from './resources/js/packages.js';

function copyFileVite(f, basePath)
{
    const cwd      = process.cwd();
    const basename = path.basename(f);

    // console.log(15, f);
    // console.log('Copy from: ' + cwd + '/' + f); // copy
    // console.log('Copy to:   ' + cwd + '/' + basePath + '/' + path.basename(f)); // copy

    copyFile(cwd + '/' + f, cwd + '/' + basePath + '/' + basename, function () {
        console.log('Copy: ' + basename)
    });
}

watch.watchTree('./vendor/la09r', function (f, curr, prev) {
    if (typeof f == "object" && prev === null && curr === null) {
        // Finished walking the tree
    } else if (prev === null) {
        // f is a new file
    } else if (curr.nlink === 0) {
        // f was removed
    } else {
        // f was changed
        if(path.extname(f) === '.vue')
        {
            for(const packageName in packages)
            {
                for(const componentsName in packages[packageName].ComponentsAsync)
                {
                    const basePath = packages[packageName].ComponentsAsync[componentsName].basePath ?? '';

                    if(f.indexOf(basePath) !== -1)
                    {
                        copyFileVite(f, basePath);
                    }
                }
                for(const componentsName in packages[packageName].Components)
                {
                    const basePath = packages[packageName].Components[componentsName].basePath ?? '';

                    if(f.indexOf(basePath) !== -1)
                    {
                        copyFileVite(f, basePath);
                    }
                }
            }
        }
    }
})