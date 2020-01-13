# Router Study

# Installation

`$ docker run --rm -v $(pwd):/app composer install`

`$ docker-compose build`

`$ docker-compose up -d`

# Usage

### Basic

```php

$http->on('GET', '/', function(){
    return 'Home Pen';
});

$http->on('GET', '/path/to/action/:upa', 'Pen\App\AuthorController->action', ['labels' => false]);

$http->on('GET', '/:path*', function(AuthorController $authorController, $path) {
    return $authorController->home($path);
});

```
