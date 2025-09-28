<?php
// Read docker-compose LAMP environment (sprintcube uses .env)
// In containers, hostname for MySQL is usually "mysql"
define('DB_HOST', getenv('MYSQL_HOST') );
define('DB_NAME', getenv('MYSQL_DATABASE') );
define('DB_USER', getenv('MYSQL_USER') );
define('DB_PASS', getenv('MYSQL_PASSWORD') ?: (getenv('MYSQL_ROOT_PASSWORD')));
