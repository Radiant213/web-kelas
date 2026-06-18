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
];

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
$compiledViewPath = '/tmp/storage/framework/views';
if (!is_dir($compiledViewPath)) {
    mkdir($compiledViewPath, 0755, true);
}
putenv('VIEW_COMPILED_PATH=' . $compiledViewPath);
$_ENV['VIEW_COMPILED_PATH'] = $compiledViewPath;
$_SERVER['VIEW_COMPILED_PATH'] = $compiledViewPath;

require __DIR__ . '/../public/index.php';
