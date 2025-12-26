<?php
declare(strict_types=1);

class Runner {
    public $cmd;
}

class Wrapper {
    public $runner;

    function __wakeup() {
        // INTENTIONAL VULN:
        // attacker controls nested object property → command execution
        if ($this->runner instanceof Runner) {
            system($this->runner->cmd);
        }
    }
}

$data = $_GET['data'] ?? '';

echo "<h2>Unserialize → RCE</h2>";

if ($data !== '') {
    // INTENTIONAL VULN: unsafe unserialize
    unserialize($data);
    echo "<p>Payload deserialized.</p>";
}

echo "<p><a href='/'>home</a></p>";
