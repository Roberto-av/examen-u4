<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

// Definir la constante BASE_PATH solo si no ha sido definida previamente
if (!defined('BASE_PATH')) {
	define('BASE_PATH', 'http://localhost/examen-u4/');
}
