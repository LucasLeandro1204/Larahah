<?php

define('LARAVEL_START', microtime(true));

use Illuminate\Support\Facades\Artisan;

passthru('touch database/testing.sqlite');
passthru('php artisan migrate --env=testing --database=sqlite');

require __DIR__.'/../vendor/autoload.php';
