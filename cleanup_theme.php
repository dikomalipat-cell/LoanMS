<?php

$dir = new RecursiveDirectoryIterator('resources/views');
$ite = new RecursiveIteratorIterator($dir);
foreach($ite as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $path = $file->getPathname();
        $content = file_get_contents($path);
        
        // Skip welcome.blade.php
        if (strpos($path, 'welcome.blade.php') !== false) continue;
        
        $originalContent = $content;

        // Fix Login Button Gradient (if any left)
        $content = str_replace('linear-gradient(135deg, #059669, #047857)', 'linear-gradient(135deg, #f5c518, #eab308)', $content);
        $content = str_replace('linear-gradient(135deg, #047857, #065f46)', 'linear-gradient(135deg, #eab308, #ca8a04)', $content);
        
        // Fix Focus rings
        $content = str_replace('focus:border-green-400', 'focus:border-gold', $content);
        $content = str_replace('focus:ring-green-100', 'focus:ring-gold/20', $content);
        
        // Fix Hover text
        $content = str_replace('hover:text-green-700', 'hover:text-gold-hover', $content);
        $content = str_replace('hover:text-green-600', 'hover:text-gold', $content);
        
        // Fix specific known links/buttons in dashboard
        $content = str_replace('text-green-600', 'text-gold', $content);
        $content = str_replace('bg-green-100', 'bg-gold/20', $content);
        $content = str_replace('bg-green-50', 'bg-primary-light', $content);
        $content = str_replace('text-green-800', 'text-gold', $content);
        $content = str_replace('text-green-700', 'text-gold', $content);

        // Sidebar Logout button
        $content = str_replace('hover:bg-red-500 hover:bg-opacity-20 hover:text-red-300', 'hover:bg-red-500/20 hover:text-red-400', $content);

        if ($content !== $originalContent) {
            file_put_contents($path, $content);
        }
    }
}
echo "Remaining green elements cleaned up!\n";
