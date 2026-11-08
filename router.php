<?php
// router.php for PHP server environments

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// If the requested file or asset actually exists on disk, serve it directly
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Otherwise, let PHP handle standard routing
require_once __DIR__ . '/index.php';
