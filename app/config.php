<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (!defined('BASE_PATH')) {
	define('BASE_PATH', 'http://localhost/examen-u4/');
}
