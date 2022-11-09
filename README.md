# NEON-Config

Config manager that that parses ini file, validates required fields and provides read-only access.

## Installation

```
composer require noxx/neon-config
```

## Usage

```php
<?php
$config_mangager = new \Trinity\ConfigManager( '/path/to/ini_file.ini' )
$config_mangager->set_required_field( 'foo' );
$config_mangager->set_required_field( 'bar' );
$config_mangager->ini_load();
echo $config_mangager->foo;
```
