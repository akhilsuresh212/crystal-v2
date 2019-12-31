<?php
if ($_SERVER['HTTP_HOST'] == 'localhost') {
	define('API_SITEURL', 'http://localhost/roto/api/');
	define('API_ABSPATH', '/var/www/html/roto/api/');
	define('SITEURL', 'http://localhost/roto/');
	define('ABSPATH', '/var/www/html/roto/api/');
	define('URI_PATH', 'roto/api/');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'phpmyadmin');
	define('DB_PASS', 'root');
	define('DB_NAME', 'roto_db');
} elseif ($_SERVER['HTTP_HOST'] == '15.206.83.119') {
	define('API_SITEURL', 'http://15.206.83.119/roto-php/api/');
	define('API_ABSPATH', '/var/www/html/roto-php/api/');
	define('SITEURL', 'http://15.206.83.119/roto-php/api/users');
	define('ABSPATH', '/var/www/html/roto-php/');
	define('URI_PATH', 'roto-php/api/');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', 'indigo*2000estd');
	define('DB_NAME', 'oscar');
}
