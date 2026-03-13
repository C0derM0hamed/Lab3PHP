<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = require __DIR__ . '/config/config.php';

spl_autoload_register(function ($className) {
    $paths = [
        __DIR__ . '/controllers/' . $className . '.php',
        __DIR__ . '/models/' . $className . '.php',
        __DIR__ . '/core/' . $className . '.php',
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

function view(string $template, array $data = []): void
{
    extract($data);
    require __DIR__ . '/views/' . $template . '.php';
}

function redirectTo(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function requireAuth(): void
{
    if (!isset($_SESSION['username'])) {
        redirectTo('index.php?route=login');
    }
}
