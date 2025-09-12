<?php
require_once __DIR__ . '/../models/User.php';

class UserController {

    public static function index() {
        send(200, User::all());
    }

    public static function show($id) {
        $row = User::find((int)$id);
        $row ? send(200,$row) : send(404,['error'=>'Not found']);
    }

    public static function create($body) {
        if (!isset($body['name'], $body['email'])) {
            send(422, ['error'=>'Missing required fields: name, email']);
        }
        $id = User::create($body['name'], $body['email']);
        send(201, User::find($id));
    }

    public static function update($id, $body) {
        $ok = User::update((int)$id, $body);
        $ok ? send(200, User::find((int)$id)) : send(404, ['error'=>'Not found']);
    }

    public static function destroy($id) {
        $ok = User::delete((int)$id);
        $ok ? send(204) : send(404, ['error'=>'Not found']);
    }
}
