# CVC Network Beanstalk Console

go to /beanstalkconsole to view the status of local beanstalk.

Note: This is NOT secure.

## Installation

### composer.json
```json
{
  "require": {
    "cvcnetwork/beanstalkconsole": "dev-master"
  }
}
```

### app.php
```php
<?php
  $providers = array(
  etc
  'CVCNetwork\BeanstalkConsole\BeanstalkConsoleServiceProvider',
  );

```

### publish your assets
This package has assets that need to be published to the public folder to achieve this use artisan, and commit the files to your main project
```php
php artisan asset:publish cvcnetwork/beanstalkconsole
```
