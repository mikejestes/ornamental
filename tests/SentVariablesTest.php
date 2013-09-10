<?php

namespace Ornamental\Tests;

class SendVariablesTest extends OrnamentalTestSuite
{
    public function testSentPlain()
    {
        $message = new \Ornamental\Message('user_welcome');
        $message->user = array('email' => 'to@example.com', 'name' => 'Joe W.');
        $message->send();

        $deliveries = \Ornamental\Deliveries::getInstance();
        $logEntry = array_shift($deliveries->log);

        $this->assertEquals('to@example.com', $logEntry->to);
        $this->assertEquals('Welcome to Ornamental, Joe W.', $logEntry->subject);
    }

    public function testSentNested()
    {
        $message = new \Ornamental\Message('user_hello');
        $message->email = 'to@example.com';
        $message->username = 'Joe W.';
        $message->send();

        $deliveries = \Ornamental\Deliveries::getInstance();
        $logEntry = array_shift($deliveries->log);

        $this->assertEquals('to@example.com', $logEntry->to);
        $this->assertEquals('Welcome to Ornamental, Joe W.', $logEntry->subject);
    }
}
