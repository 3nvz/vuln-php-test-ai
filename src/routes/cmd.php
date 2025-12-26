<?php
declare(strict_types=1);

$host = $_GET['host'] ?? '127.0.0.1';
// INTENTIONAL VULN: command injection
$cmd = "ping -c 1 " . $host . " 2>&1";
$out = shell_exec($cmd);

echo "<h2>Command exec (Injection)</h2>";
echo "<p>Command: <code>" . h($cmd) . "</code></p>";
echo "<pre>" . h((string)$out) . "</pre>";
echo "<p><a href='/'>home</a></p>";
