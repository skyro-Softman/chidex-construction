<?php
// router.php for PHP server environments

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// If the requested file or asset actually exists on disk, serve it directly
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Map clean URL requests to their respective physical PHP files if they exist
$requested_file = __DIR__ . $uri;
if (file_exists($requested_file . '.php')) {
    require_once $requested_file . '.php';
    exit();
}

// Otherwise, fallback to index.php
require_once __DIR__ . '/index.php';
