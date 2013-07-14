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