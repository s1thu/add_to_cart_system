<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// ✅ Load config first to define constants
require_once __DIR__ . '/../app/config/Config.php';

// ✅ Autoload classes (so you don't need `require_once` everywhere)
require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../app/routes/api.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}