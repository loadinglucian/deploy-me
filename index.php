<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

$message = 'Couldn not read your .env file 🤷‍♂️';

try {
    $dotenv = new Dotenv();
    $dotenv->loadEnv(__DIR__ . '/.env');
    $message = $_ENV['APP_MESSAGE'] ?? 'Your APP_MESSAGE .env variable is missing 🤷‍♂️';
} catch (Exception $e) {
    $message = $e->getMessage() . ' 😨';
}

function viteAssets(): string
{
    $devServerUrl = 'http://localhost:5173';
    $manifestPath = __DIR__ . '/dist/.vite/manifest.json';

    // Check if Vite dev server is running
    $devServerRunning = false !== @file_get_contents($devServerUrl . '/@vite/client', false, stream_context_create([
        'http' => ['timeout' => 0.5]
    ]));

    if ($devServerRunning) {
        return <<<HTML
        <script type="module" src="{$devServerUrl}/@vite/client"></script>
        <link rel="stylesheet" href="{$devServerUrl}/src/main.css">
        HTML;
    }

    // Production: read manifest
    if (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true);
        $cssFile = $manifest['src/main.css']['file'] ?? null;
        if ($cssFile) {
            return '<link rel="stylesheet" href="/dist/' . $cssFile . '">';
        }
    }

    return '';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deploy Me</title>
    <?= viteAssets() ?>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 transition-colors">
    <div class="text-4xl font-medium text-gray-900 dark:text-white font-sans tracking-tight [&_a]:text-blue-600 dark:[&_a]:text-blue-400 [&_a]:underline [&_a]:hover:text-blue-700 dark:[&_a]:hover:text-blue-300 [&_a]:transition-colors">
        <?= strip_tags($message, '<a>') ?>
    </div>
</body>
</html>
