Ornamental
==========

A library to send templated transactional emails. Plugins for your choice of template language and mail sending library. Configuration through YAML.

[![Build Status](https://travis-ci.org/mikejestes/ornamental.png?branch=master)](https://travis-ci.org/mikejestes/ornamental)

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

// optionally prefix emails with a string
$setup->subjectPrefix = '[test] ';

// set default variables across all messages
$setup->defaults = array(
    'website_url' => 'http://example.com/',
);

// add phpmailer sender
$phpmailer = new \Ornamental\Sender\Phpmailer();
$phpmailer->smtpHost = 'smtp.example.com';
$phpmailer->smtpUsername = 'root';
$phpmailer->smtpPassword = 'password';

$setup->addSender($phpmailer);

//  \Ornamental\Sender\Logger is a sender that logs to a PSR logger class
$setup->addSender(new \Ornamental\Sender\Logger($logger));
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
