<?php
// Simple diagnostic to list contents of /home/site/wwwroot recursively (depth 2)
function listDir($path, $depth = 0, $maxDepth = 2) {
    if ($depth > $maxDepth) return;
    $items = @scandir($path);
    if ($items === false) {
        echo "Cannot read: $path\n";
        return;
    }
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $full = $path . DIRECTORY_SEPARATOR . $item;
        $type = is_dir($full) ? 'DIR ' : 'FILE';
        echo str_repeat('  ', $depth) . "$type: $full\n";
        if (is_dir($full)) listDir($full, $depth + 1, $maxDepth);
    }
}

echo "Azure Diagnostic\n";
echo "CWD: " . getcwd() . "\n";
echo "DOCROOT listing (depth 2):\n";
listDir('/home/site/wwwroot', 0, 2);
echo "\nVendor autoload check: ";
echo file_exists('/home/site/wwwroot/vendor/autoload.php') ? 'FOUND' : 'NOT FOUND';
echo "\nPublic index check: ";
echo file_exists('/home/site/wwwroot/public/index.php') ? 'FOUND' : 'NOT FOUND';
echo "\nRoot index check: ";
echo file_exists('/home/site/wwwroot/index.php') ? 'FOUND' : 'NOT FOUND';
echo "\n";
