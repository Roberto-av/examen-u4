<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

$basePath = getenv('BASE_PATH') ?: 'http://localhost/examen-u4/';

if (!defined('BASE_PATH')) {
	define('BASE_PATH', $basePath);
}

$loginPath = getenv('LOGIN_PATH') ?: '/examen-u4/';

if ($_SERVER['REQUEST_URI'] == $loginPath) {
    if (isset($_SESSION["user_data"])) {
        header('Location: ' . $basePath . 'home'); 
    }
} else {
    if (!isset($_SESSION["user_data"])) {
        header('Location: ' . $basePath);
    }
}