<?php

// Forward Vercel env vars to PHP
$envVars = [
    'APP_NAME', 'APP_ENV', 'APP_KEY', 'APP_DEBUG', 'APP_URL', 'APP_LOCALE',
    'APP_FALLBACK_LOCALE', 'APP_FAKER_LOCALE',
    'DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD',
    'MYSQL_ATTR_SSL_CA',
    'SESSION_DRIVER', 'SESSION_LIFETIME', 'SESSION_ENCRYPT', 'SESSION_PATH', 'SESSION_DOMAIN',
    'BROADCAST_CONNECTION', 'FILESYSTEM_DISK', 'QUEUE_CONNECTION',
    'CACHE_STORE', 'LOG_CHANNEL', 'LOG_STACK', 'LOG_LEVEL',
    'BCRYPT_ROUNDS',
    'AWS_ACCESS_KEY_ID', 'AWS_SECRET_ACCESS_KEY', 'AWS_DEFAULT_REGION',
    'AWS_BUCKET', 'AWS_ENDPOINT', 'AWS_URL', 'AWS_USE_PATH_STYLE_ENDPOINT'
];

// Parse .env.production directly if it exists
$envFile = __DIR__ . '/../.env.production';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $key = trim($parts[0]);
            $val = trim($parts[1]);
            // Remove surrounding quotes if they exist
            if (preg_match('/^"(.*)"$/', $val, $matches) || preg_match("/^'(.*)'$/", $val, $matches)) {
                $val = $matches[1];
            }
            $_ENV[$key] = $val;
            $_SERVER[$key] = $val;
            putenv("$key=$val");
        }
    }
}

foreach ($envVars as $key) {
    $value = getenv($key);
    if ($value !== false) {
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

// Set the MYSQL_ATTR_SSL_CA to ca.pem if available
if (!getenv('MYSQL_ATTR_SSL_CA') || getenv('MYSQL_ATTR_SSL_CA') === '') {
    $caPath = __DIR__ . '/../ca.pem';
    if (file_exists($caPath)) {
        $_ENV['MYSQL_ATTR_SSL_CA'] = $caPath;
        $_SERVER['MYSQL_ATTR_SSL_CA'] = $caPath;
        putenv('MYSQL_ATTR_SSL_CA=' . $caPath);
    }
}

// Boot Laravel
$storagePath = '/tmp/storage';
if (!is_dir($storagePath)) {
    mkdir($storagePath, 0755, true);
    mkdir($storagePath . '/framework/cache', 0755, true);
    mkdir($storagePath . '/framework/views', 0755, true);
    mkdir($storagePath . '/framework/sessions', 0755, true);
    mkdir($storagePath . '/logs', 0755, true);
}
putenv('LARAVEL_STORAGE_PATH=' . $storagePath);
$_ENV['LARAVEL_STORAGE_PATH'] = $storagePath;
$_SERVER['LARAVEL_STORAGE_PATH'] = $storagePath;

require __DIR__ . '/../public/index.php';
