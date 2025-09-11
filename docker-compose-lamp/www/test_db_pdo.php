<?php
declare(strict_types=1);
require __DIR__.'/dbconn.php';

try{
    $database = pdo();
    $version = $database->query("SELECT VERSION()")->fetchColumn();
    echo "Success: A proper connection to MySQL was made! The docker database is great.";    
} catch(PDOException $e) {
    http_response_code(500);
    echo "Error: Unable to connect to MySQL. Error:\n $e";
}
