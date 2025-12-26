<?php
declare(strict_types=1);

function h(string $s): string {
  // safe HTML escaping helper (not used everywhere on purpose)
  return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
