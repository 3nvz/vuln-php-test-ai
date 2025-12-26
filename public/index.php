<?php
// vulnphp-mini: intentionally vulnerable mini app for taint-analysis testing.
// DO NOT deploy on the internet. Run locally only.

declare(strict_types=1);

require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../src/util.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';

switch ($path) {
  case '/':
    echo "<h1>vulnphp-mini</h1>";
    echo "<ul>";
    echo "<li><a href='/search'>SQLi search</a></li>";
    echo "<li><a href='/echo?msg=Hello'>Reflected XSS</a></li>";
    echo "<li><a href='/file?name=notes.txt'>LFI-ish file read</a></li>";
    echo "<li><a href='/cmd?host=127.0.0.1'>Command injection</a></li>";
    echo "<li><a href='/upload'>Arbitrary upload + include</a></li>";
    echo "<li><a href='/ssrf?url=http://example.com'>SSRF-like fetch</a></li>";
    echo "<li><a href='/deserialize?data='>PHP Object Injection</a></li>";
    echo "<li><a href='/deserialize-cmd?data='>PHP Object Injection (RCE)</a></li>";
    echo "</ul>";
    break;

  case '/search':
    require __DIR__ . '/../src/routes/search.php';
    break;

  case '/echo':
    require __DIR__ . '/../src/routes/echo.php';
    break;

  case '/file':
    require __DIR__ . '/../src/routes/file.php';
    break;

  case '/cmd':
    require __DIR__ . '/../src/routes/cmd.php';
    break;

  case '/upload':
    require __DIR__ . '/../src/routes/upload.php';
    break;

  case '/ssrf':
    require __DIR__ . '/../src/routes/ssrf.php';
    break;

  case '/deserialize':
    require __DIR__ . '/../src/routes/deserialize.php';
    break;

  case '/deserialize-cmd':
    require __DIR__ . '/../src/routes/deserialize_cmd.php';
    break;


  default:
    http_response_code(404);
    echo "404";
}
