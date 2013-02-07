Ornamental
==========

A library to send templated transactional emails. Plugins for your choice of template language and mail sending library. Configuration through YAML.

## Installation

Add to your `composer.json` file:

```yaml
"require": {
    "mikejestes/ornamental": "*"
}
```

Then download and run [composer](http://getcomposer.org/):

    curl -s https://getcomposer.org/installer | php
    php composer.phar install

## Configuration

```php
$setup = \Ornamental\Settings::getInstance();
$setup->templateDir = __DIR__ . '/templates/';
$setup->layoutDir = __DIR__ . '/layouts/';
$setup->messageDir = __DIR__ . '/messages/';

$setup->sender = new \Ornamental\Sender\Phpmailer();
$setup->sender->smtpHost = 'smtp.example.com';
$setup->sender->smtpUsername = 'root';
$setup->sender->smtpPassword = 'password';
```

## Usage

```php
$email = new \Ornamental\Message('user_welcome');
$email->user = array('name' => "Joe User");
$email->send();
```

## Current Plugins

Templating:
* mustache (install `mustache/mustache` from composer)

Mail Transport:
* phpmailer (install `phpmailer/phpmailer`)

## Integration with unit tests
Unit tests can inspect the send log:
```php
$deliveries = \Ornamental\Deliveries::getInstance();
$this->assertEquals(2, count($deliveries->log));
```
