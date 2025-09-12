<?php
// Read docker-compose LAMP environment (sprintcube uses .env)
// In containers, hostname for MySQL is usually "mysql"
define('DB_HOST', getenv('MYSQL_HOST') ?: 'mysql');
define('DB_NAME', getenv('MYSQL_DATABASE') ?: 'app');
define('DB_USER', getenv('MYSQL_USER') ?: 'root');
define('DB_PASS', getenv('MYSQL_PASSWORD') ?: (getenv('MYSQL_ROOT_PASSWORD') ?: 'root'));
