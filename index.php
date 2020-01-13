<?php
require __DIR__ . '/vendor/autoload.php';

use Pen\App\AuthorController;
use Pen\App;

$http = new App([
    'separator' => '->',
    'labels' => true
]);

$http->on('GET', '/', function(){
    return 'Home Pen';
});

$http->on('GET', '/path/to/action/:upa', 'Pen\App\AuthorController->action', ['labels' => false]);

$http->on('GET', '/:path*', function(AuthorController $authorController, $path) {
    return $authorController->home($path);
});

$http->handler();

