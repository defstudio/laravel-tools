# laravel-tools

## Installation
You can install this package via Composer:

`composer require defstudio/laravel-tools`

## Setup

### Publishing Assets



### Composer Scripts
Add the following scripts to composer.json

```
"php-cs-fixer": "php-cs-fixer fix -v --config=./.php-cs-fixer.php",
"lint": "@php-cs-fixer",
"test:lint": "@php-cs-fixer --dry-run",
"test:types": "php ./vendor/bin/phpstan analyse --ansi --memory-limit=0",
"test": "php ./vendor/bin/pest --colors=always --parallel",
"test:all": [
    "@test:lint",
    "@test:types",
    "@test"
]
```
