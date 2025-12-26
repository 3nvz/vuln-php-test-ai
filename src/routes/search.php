<?php
declare(strict_types=1);

init_db();

$q = $_GET['q'] ?? '';
// INTENTIONAL VULN: SQL injection via string concatenation.
$sql = "SELECT id, username, bio FROM users WHERE username LIKE '%" . $q . "%' ORDER BY id DESC";
$rows = db()->query($sql)->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Search (SQLi)</h2>";
echo "<form>";
echo "<input name='q' value='" . $q . "' />"; // INTENTIONAL VULN: reflected XSS via unescaped attribute
echo "<button>Search</button>";
echo "</form>";

echo "<p>SQL: <code>" . $sql . "</code></p>";
echo "<ul>";
foreach ($rows as $r) {
  echo "<li>#{$r['id']} {$r['username']} - {$r['bio']}</li>"; // INTENTIONAL VULN: stored XSS via bio
}
echo "</ul>";
echo "<p><a href='/'>home</a></p>";
