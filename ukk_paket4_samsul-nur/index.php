<?php
session_start();

// Define base URL
define('BASE_URL', 'http://localhost/ukk_paket4_samsul-nur');

// Autoload classes
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/app/Controllers/' . $class . '.php',
        __DIR__ . '/app/Models/' . $class . '.php',
        __DIR__ . '/app/Core/' . $class . '.php',
        __DIR__ . '/app/Config/' . $class . '.php'
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Initialize router
$router = new Router();