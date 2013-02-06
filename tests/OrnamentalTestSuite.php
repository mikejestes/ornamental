<?php

namespace Ornamental\Tests;

class OrnamentalTestSuite extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $setup = \Ornamental\Settings::getInstance();
        $setup->templateDir = __DIR__ . '/templates/';
        $setup->layoutDir = __DIR__ . '/layouts/';
        $setup->messageDir = __DIR__ . '/messages/';
    }
}
