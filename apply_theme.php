<?php

$dir = new RecursiveDirectoryIterator('resources/views');
$ite = new RecursiveIteratorIterator($dir);
foreach($ite as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $path = $file->getPathname();
        $content = file_get_contents($path);
        
        // Skip welcome.blade.php
        if (strpos($path, 'welcome.blade.php') !== false) continue;
        
        // Replace CDN tailwind with Vite
        $content = preg_replace('/<link href="https:\/\/cdn.jsdelivr.net\/npm\/tailwindcss.*?rel="stylesheet">/', '@vite([\'resources/css/app.css\', \'resources/js/app.js\'])', $content);
        
        // Add custom styles to layout
        if (strpos($path, 'app.blade.php') !== false) {
            $customStyles = "<style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', sans-serif; }
        .bg-primary-dark { background-color: #0f172a; } /* Slate 900 */
        .bg-primary { background-color: #1e293b; } /* Slate 800 */
        .bg-primary-light { background-color: #334155; } /* Slate 700 */
        .text-gold { color: #f5c518; }
        .bg-gold { background-color: #f5c518; }
        .border-gold { border-color: #f5c518; }
        .hover-bg-gold:hover { background-color: #eab308; }
    </style>";
            $content = str_replace('<style>', $customStyles . "\n    <style>", $content);
            $content = str_replace("body { background-color: #f3f4f6; }", "body { background-color: #0f172a; }", $content);
            $content = str_replace('bg-gray-100 text-gray-800', 'bg-primary-dark text-slate-300', $content);
            $content = str_replace('bg-white', 'bg-primary', $content);
            $content = str_replace('border-gray-200', 'border-slate-700', $content);
            $content = str_replace('text-gray-800', 'text-slate-200', $content);
            $content = str_replace('text-gray-500', 'text-slate-400', $content);
            $content = str_replace('text-gray-400', 'text-slate-500', $content);
        }
        
        if (strpos($path, 'sidebar.blade.php') !== false) {
            $content = str_replace('background: linear-gradient(180deg, #064e3b 0%, #065f46 60%, #047857 100%);', 'background: #0f172a; border-right: 1px solid #1e293b;', $content);
            $content = str_replace('bg-green-400', 'bg-gold', $content);
            $content = str_replace('text-green-300', 'text-gold', $content);
            $content = str_replace('text-green-200', 'text-slate-400', $content);
            $content = str_replace('border-green-700', 'border-slate-800', $content);
            $content = str_replace('text-green-400', 'text-slate-500', $content);
            $content = str_replace('bg-green-100', 'bg-gold/20', $content);
            $content = str_replace('text-green-600', 'text-gold', $content);
        }

        if (strpos($path, 'header.blade.php') !== false) {
            $content = str_replace('bg-white border-b border-gray-200', 'bg-primary border-b border-slate-800', $content);
            $content = str_replace('text-gray-700', 'text-slate-200', $content);
            $content = str_replace('text-gray-500', 'text-slate-400', $content);
            $content = str_replace('text-gray-800', 'text-slate-200', $content);
            $content = str_replace('bg-gradient-to-br from-green-400 to-green-600', 'bg-gold', $content);
            $content = str_replace('bg-gray-100 border-transparent', 'bg-primary-dark border-slate-700', $content);
            $content = str_replace('text-white text-xs font-bold', 'text-primary-dark text-xs font-bold', $content);
        }
        
        if (strpos($path, 'login.blade.php') !== false) {
            $content = preg_replace('/<link href="https:\/\/cdn.jsdelivr.net\/npm\/tailwindcss.*?rel="stylesheet">/', '@vite([\'resources/css/app.css\', \'resources/js/app.js\'])', $content);
            $content = str_replace('bg-gray-50', 'bg-primary-dark', $content);
            $content = str_replace('bg-white', 'bg-primary', $content);
            $content = str_replace('text-gray-800', 'text-white', $content);
            $content = str_replace('text-gray-600', 'text-slate-400', $content);
            $content = str_replace('border-gray-200', 'border-slate-700', $content);
            $content = str_replace('bg-green-600', 'bg-gold', $content);
            $content = str_replace('hover:bg-green-700', 'hover-bg-gold text-primary-dark', $content);
            $content = str_replace('text-green-600', 'text-gold', $content);
            $content = str_replace('focus:ring-green-500', 'focus:ring-gold', $content);
            $content = str_replace('focus:border-green-500', 'focus:border-gold', $content);
        }

        // Global replacements for other files
        if (strpos($path, 'app.blade.php') === false && strpos($path, 'sidebar.blade.php') === false && strpos($path, 'header.blade.php') === false && strpos($path, 'login.blade.php') === false && strpos($path, 'welcome.blade.php') === false) {
            $content = str_replace('bg-white', 'bg-primary', $content);
            $content = str_replace('text-gray-800', 'text-white', $content);
            $content = str_replace('text-gray-600', 'text-slate-300', $content);
            $content = str_replace('text-gray-500', 'text-slate-400', $content);
            $content = str_replace('border-gray-200', 'border-slate-700', $content);
            $content = str_replace('border-gray-100', 'border-slate-700', $content);
            $content = str_replace('bg-gray-50', 'bg-primary-dark', $content);
            $content = str_replace('bg-gray-100', 'bg-primary-dark', $content);
            
            // Convert green accents to gold, but leave explicit success badges alone if possible.
            $content = str_replace('bg-green-600', 'bg-gold text-primary-dark', $content);
            $content = str_replace('hover:bg-green-700', 'hover-bg-gold', $content);
            $content = str_replace('bg-gradient-to-r from-green-800 to-green-600', 'bg-gradient-to-r from-primary to-primary-light border border-slate-700', $content);
            $content = str_replace('text-green-700', 'text-gold', $content);
            $content = str_replace('text-green-100', 'text-gold-light', $content);
            $content = str_replace('text-green-200', 'text-gold-light', $content);
        }
        
        file_put_contents($path, $content);
    }
}
echo "Theme applied successfully!\n";
