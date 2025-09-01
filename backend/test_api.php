<?php

// Start the Laravel application
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

// Simulate a request to our API
use Illuminate\Http\Request;

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Test Categories endpoint
echo "Testing Categories API:\n";
$request = Request::create('/api/v1/categories', 'GET');
$response = $kernel->handle($request);
echo "Status: " . $response->getStatusCode() . "\n";
echo "Response: " . $response->getContent() . "\n\n";

// Test Menu endpoint  
echo "Testing Menu API:\n";
$request = Request::create('/api/v1/menu', 'GET');
$response = $kernel->handle($request);
echo "Status: " . $response->getStatusCode() . "\n";
echo "Response: " . $response->getContent() . "\n\n";

// Test Menu Items endpoint
echo "Testing Menu Items API:\n";
$request = Request::create('/api/v1/menu-items', 'GET');
$response = $kernel->handle($request);
echo "Status: " . $response->getStatusCode() . "\n";
echo "Response: " . substr($response->getContent(), 0, 200) . "...\n";

$kernel->terminate($request, $response);
