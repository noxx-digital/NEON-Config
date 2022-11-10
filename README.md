# NEON-Config

Config classes that are parsing ini file and providing a read-only config class.

## Installation

```
composer require noxx/neon-config
```

## Usage

```php

require __DIR__ . '/../vendor/autoload.php';

use Neon\Config\ConfigParser;
use Neon\Config\Exception\FileNotFoundException;
use Neon\Config\Exception\IniParseException;

try
{
    $config_parser = new ConfigParser();
    $app_config = $config_parser->load_config( './example.ini' );
    var_dump( $app_config );
}
catch ( FileNotFoundException $e )
{
    // do smth
}
catch ( IniParseException $e )
{
    // do smth else
}

```
