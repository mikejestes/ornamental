<?php

namespace Ornamental\Tests;

class DefaultsTest extends OrnamentalTestSuite
{
    public function testDefaultsInBodyAndTo()
    {
        $setup = \Ornamental\Settings::getInstance();
        $setup->defaults = array(
            'email' => 'default@example.com',
            'username' => 'default',
        );

        $message = new \Ornamental\Message('user_defaults');
        $message->send();

        $deliveries = \Ornamental\Deliveries::getInstance();
        $this->assertEquals(1, count($deliveries->log));
        $message = array_pop($deliveries->log);
        $this->assertEquals('default@example.com', $message->to);
        $this->assertEquals('Welcome to Ornamental, default', $message->subject);
    }

}
