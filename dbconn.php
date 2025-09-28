<?php
declare(strict_types=1);

function pdo(): PDO {
    $host = getenv('MYSQL_HOST');
    $port   = (int)getenv('MYSQL_PORT');
    $db     = getenv('MYSQL_DATABASE');
    $user   = getenv('MYSQL_USER');
    $pass   = getenv('MYSQL_PASSWORD');

    $dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";
    $option = [
        PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES      => false,
    ];
    return new PDO($dsn, $user, $pass, $option);
}