<?php
class Router {
  private array $routes = [];

  public function add($methods, string $pattern, callable $handler) {
    $keys = [];
    $regex = preg_replace_callback('#:([A-Za-z_]\w*)#', function($m) use (&$keys) {
      $keys[] = $m[1]; return '([^/]+)';
    }, $pattern);
    $regex = '#^' . $regex . '$#';
    $this->routes[] = [array_map('strtoupper',(array)$methods), $regex, $keys, $handler];
  }

  public function dispatch(string $method, string $path) {
    $allowed = [];
    foreach ($this->routes as [$methods, $regex, $keys, $handler]) {
      if (preg_match($regex, $path, $m)) {
        if (!in_array($method, $methods, true)) { $allowed = array_merge($allowed, $methods); continue; }
        array_shift($m); $params = array_combine($keys, $m) ?: [];
        return $handler($params);
      }
    }
    if ($allowed) { header('Allow: '.implode(', ', array_unique($allowed))); http_response_code(405); echo json_encode(['error'=>'Method Not Allowed']); }
    else { http_response_code(404); echo json_encode(['error'=>'Not Found']); }
    exit;
  }
}
