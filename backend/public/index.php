<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// ✅ Load config first to define constants
require_once __DIR__ . '/../app/config/Config.php';

// ✅ Autoload classes (so you don't need `require_once` everywhere)
require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../app/routes/api.php';