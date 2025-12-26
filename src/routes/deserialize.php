<?php
declare(strict_types=1);

class Logger {
    public $file;

    function __destruct() {
        // INTENTIONAL VULN: attacker-controlled file write via object injection
        file_put_contents($this->file, "pwned\n", FILE_APPEND);
    }
}

$payload = $_GET['data'] ?? '';

echo "<h2>Unserialize (PHP Object Injection)</h2>";

if ($payload !== '') {
    // INTENTIONAL VULN: unsafe unserialize on user input
    unserialize($payload);
    echo "<p>Object unserialized.</p>";
}

echo "<p><a href='/'>home</a></p>";
