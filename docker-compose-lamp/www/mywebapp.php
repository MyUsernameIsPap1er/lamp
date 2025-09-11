<?php
declare(strict_types=1);
session_start();
require __DIR__.'/dbconn.php';

/**
 * Basic config with safe defaults for your compose setup.
 * If you add these as environment variables in the php service,
 * getenv() will pick them up; otherwise defaults are used.
 */
try {
    $pdo = pdo();
    $v = $pdo->query("SELECT VERSION()")->fetchColumn();
    //echo "Database version: " . htmlspecialchars($v);
} catch (PDOException $e) {
    http_response_code(500);
    exit('Database connection failed: ' . $e->getMessage());
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Web App</title>
  <link rel="shortcut icon" href="/assets/images/favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="/assets/css/bulma.min.css">
</head>
<body>
  <section class="section">
    <div class="container">
      <h1 class="title">My Web App</h1>
      <p class="subtitle">A simple web application running on LAMP stack with Docker Compose.</p>
    </div>
  </section>
</body>
</html>