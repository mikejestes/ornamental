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

## Defining Messages

Yaml files configure each email message type. The filename minus `.yaml` is the key when constructing a `\Ornamental\Message` object. 

```yaml
from: service@example.com
fromName: "{{ company }}"
to: "{{user.email}}"
subject: "Welcome to Ornamental, {{user.name}}"
layout: welcome
template: user_welcome
required:
    - user
```

## Layouts

Layout files can be used to separate themes. The body of each individual message is injected with the `body` variable, which should be unescaped in mustache (`{{{body}}}`).

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

Data as passed to each template by setting properties on the `\Ornamental\Message` object:

```php
$email = new \Ornamental\Message('user_welcome');
$email->user = array('name' => "Joe User");
$email->send();
```

## Current Plugins

Templating:
* mustache (install `mustache/mustache` from composer)
* php

Mail Transport:
* phpmailer (install `phpmailer/phpmailer`)
* log file

## Integration with unit tests
Unit tests can inspect the send log:
```php
$deliveries = \Ornamental\Deliveries::getInstance();
$this->assertEquals(2, count($deliveries->log));
```
