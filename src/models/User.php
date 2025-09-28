<?php
require_once __DIR__ . '/../lib/Database.php';

class User {

    public static function all(): array {
        $sql = 'SELECT id, name, email, status, created_at FROM users ORDER BY id';
        return Database::pdo()->query($sql)->fetchAll();
    }

    public static function find(int $id): ?array {
        $st = Database::pdo()->prepare('SELECT id, name, email, status, created_at FROM users WHERE id = ?');
        $st->execute([$id]);
        $row = $st->fetch();
        return $row ?: null;
    }

    public static function create(string $name, string $email): int {
        $st = Database::pdo()->prepare('INSERT INTO users (name, email) VALUES (?, ?)');
        $st->execute([$name, $email]);
        return (int)Database::pdo()->lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        $fields = [];
        $values = [];
        foreach (['name', 'email', 'status'] as $col) {
            if (isset($data[$col])) {
                $fields[] = "$col = ?";
                $values[] = $data[$col];
            }
        }
        if (!$fields) return true;
        $values[] = $id;
        $sql = 'UPDATE users SET ' . implode(', ', $fields) . ' WHERE id=?';
        $st = Database::pdo()->prepare($sql);;
        $st->execute($values); 
        return $st->rowCount() > 0;
    }

    public static function delete(int $id): bool {
        $st = Database::pdo()->prepare('DELETE FROM users WHERE id=?');
        $st->execute([$id]);
        return $st->rowCount() > 0;
    }
}
