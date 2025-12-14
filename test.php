<?php
echo "TEST FILE WORKS!<br>";
echo "DIR: " . __DIR__ . "<br>";
echo "FILES: " . implode(", ", array_slice(scandir(__DIR__), 0, 10));
?>
