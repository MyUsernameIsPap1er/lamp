<?php
require_once __DIR__ . '/../controllers/UserController.php';

$router->add(['GET'],  '/users',      fn()        => UserController::index());
$router->add(['POST'], '/users',      fn()        => UserController::create(jsonBody()));
$router->add(['GET'],  '/users/:id',  fn($p)      => UserController::show($p['id']));
$router->add(['PATCH','PUT'], '/users/:id', fn($p) => UserController::update($p['id'], jsonBody()));
$router->add(['DELETE'], '/users/:id',fn($p)      => UserController::destroy($p['id']));
