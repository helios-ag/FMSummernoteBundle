<?php

declare(strict_types=1);

use Symfony\Component\ErrorHandler\Debug;

if (!file_exists($file = __DIR__.'/../vendor/autoload.php')) {
    throw new \RuntimeException('Install the dependencies to run the test suite.');
}

$loader = require $file;

// Enable debug mode
Debug::enable();

// Set default timezone if not configured
if (!ini_get('date.timezone')) {
    date_default_timezone_set('UTC');
}

// Ensure the cache directory exists
$cacheDir = __DIR__.'/../var/cache/test';
if (!file_exists($cacheDir)) {
    mkdir($cacheDir, 0777, true);
}
