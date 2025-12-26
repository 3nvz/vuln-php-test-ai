<?php
declare(strict_types=1);

$name = $_GET['name'] ?? 'notes.txt';
// INTENTIONAL VULN: path traversal / local file read (no normalization)
$path = __DIR__ . '/../../data/' . $name;

echo "<h2>File read (LFI-ish)</h2>";
echo "<p>Reading: <code>" . $path . "</code></p>";

if (file_exists($path)) {
  header('Content-Type: text/plain; charset=utf-8');
  echo file_get_contents($path);
} else {
  echo "Not found";
}

echo "<p><a href='/'>home</a></p>";
