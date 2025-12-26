<?php
declare(strict_types=1);

$url = $_GET['url'] ?? 'http://example.com';
// INTENTIONAL VULN: SSRF-like fetch (no allowlist)
$ctx = stream_context_create([
  'http' => [
    'timeout' => 3,
    'follow_location' => 1,
  ]
]);

echo "<h2>Fetch (SSRF-like)</h2>";
echo "<form>";
echo "<input name='url' size='60' value='" . $url . "' />"; // INTENTIONAL VULN: reflected XSS in attribute
echo "<button>Fetch</button>";
echo "</form>";

$body = @file_get_contents($url, false, $ctx);
if ($body === false) {
  echo "<p>Fetch failed.</p>";
} else {
  echo "<h3>Response (first 2KB)</h3>";
  echo "<pre>" . h(substr($body, 0, 2048)) . "</pre>";
}
echo "<p><a href='/'>home</a></p>";
