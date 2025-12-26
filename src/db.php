<?php
declare(strict_types=1);

function db(): PDO {
  static $pdo = null;
  if ($pdo instanceof PDO) return $pdo;

  $path = __DIR__ . '/../data/app.db';
  $pdo = new PDO('sqlite:' . $path);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $pdo;
}

function init_db(): void {
  $pdo = db();
  $pdo->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    bio TEXT NOT NULL
  )");

  // Seed a few rows
  $count = (int)$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
  if ($count === 0) {
    $pdo->exec("INSERT INTO users(username,bio) VALUES
      ('alice','Loves cats'),
      ('bob','Enjoys <b>bold</b> tags'),
      ('carol','Has a "quote" in bio')
    ");
  }
}
