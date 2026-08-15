<?php
// Router for local development with PHP's built-in server:
//   php -S localhost:8000 api/router.php
// Maps POST /api/chat (and /api/chat.php) to chat.php; all other requests are served as static files.
// (Run from the project root so static files resolve correctly.)

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/api/chat' || $uri === '/api/chat.php') {
    require __DIR__ . '/chat.php';
    return true;
}

return false;
