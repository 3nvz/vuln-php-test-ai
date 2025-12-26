<?php
declare(strict_types=1);

$msg = $_GET['msg'] ?? '';
echo "<h2>Echo (Reflected XSS)</h2>";
// INTENTIONAL VULN: reflected XSS
echo "You said: " . $msg;

echo "<hr>";
echo "<p>Safe version would be: " . h($msg) . "</p>";
echo "<p><a href='/'>home</a></p>";
