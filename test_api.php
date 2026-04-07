<?php

// Quick API test
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/bootstrap/app.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Simulate API GET request
$request = Illuminate\Http\Request::create('/api/muallafs', 'GET');
$response = $kernel->handle($request);

echo "=== API GET /api/muallafs ===\n";
echo $response->getContent() . "\n\n";

// Test successful response
$responseData = json_decode($response->getContent(), true);
if (isset($responseData['success']) && $responseData['success']) {
    echo "✓ API response format correct\n";
    echo "✓ Total muallafs: " . $responseData['count'] . "\n";
} else {
    echo "✗ API response format incorrect\n";
}
