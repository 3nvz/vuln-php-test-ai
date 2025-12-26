<?php
declare(strict_types=1);

$uploads = __DIR__ . '/../../data/uploads';
if (!is_dir($uploads)) mkdir($uploads, 0777, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'] ?? 'payload.php';
  // INTENTIONAL VULN: arbitrary file upload with attacker-controlled name and no validation
  $dest = $uploads . '/' . $name;

  if (!empty($_FILES['f']['tmp_name'])) {
    move_uploaded_file($_FILES['f']['tmp_name'], $dest);
    echo "<p>Uploaded to: <code>" . h($dest) . "</code></p>";
  }

  // INTENTIONAL VULN: include attacker-controlled file path (within uploads folder, but name is controlled)
  if (isset($_POST['include'])) {
    $inc = $uploads . '/' . ($name);
    echo "<p>Including: <code>" . h($inc) . "</code></p>";
    include $inc;
  }

  echo "<p><a href='/upload'>back</a></p>";
  exit;
}

echo "<h2>Upload + include</h2>";
echo "<form method='POST' enctype='multipart/form-data'>";
echo "<p>Filename: <input name='name' value='payload.php'></p>";
echo "<p>File: <input type='file' name='f'></p>";
echo "<p><label><input type='checkbox' name='include' value='1'> include after upload</label></p>";
echo "<button>Submit</button>";
echo "</form>";
echo "<p>Try uploading a PHP file that echoes something.</p>";
echo "<p><a href='/'>home</a></p>";
