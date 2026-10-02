<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$token = DB::table('personal_access_tokens')->latest()->first();
if ($token) {
    echo "Latest Token ID in DB: " . $token->id . "\n";
} else {
    echo "No tokens found in DB.\n";
}
