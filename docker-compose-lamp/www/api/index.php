<?php
// Basic headers for JSON & CORS (dev-friendly)
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }

// Load app core
require_once __DIR__ . '/../src/lib/Router.php';
require_once __DIR__ . '/../src/config/config.php';   // sets up env + db
require_once __DIR__ . '/../src/lib/Database.php';

// Helpers
function send($status, $payload = null) {
  http_response_code($status);
  echo $payload !== null ? json_encode($payload, JSON_UNESCAPED_UNICODE) : '';
  exit;
}
function jsonBody() {
  $raw = file_get_contents('php://input');
  if (!$raw) return [];
  $data = json_decode($raw, true);
  if (json_last_error() !== JSON_ERROR_NONE) send(400, ['error'=>'Invalid JSON: '.json_last_error_msg()]);
  return $data;
}

// Build router
$route = $_GET['route'] ?? '';
$path  = '/' . trim($route, '/');
$method = $_SERVER['REQUEST_METHOD'];
$router = new Router();

/** */
$router->add(['GET'], '/ping', fn() => send(200, ['pong'=>true, 'time'=>gmdate('c')]) );
$router->add(['GET'], '/health', fn() => send(200, ['status'=>'ok']));

// Register route groups
require_once __DIR__ . '/../src/routes/users.php';


$router->dispatch($method, $path);
