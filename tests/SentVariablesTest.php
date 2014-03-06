<?php

namespace Ornamental\Tests;

class SentVariablesTest extends OrnamentalTestSuite
{
    public function testSentPlain()
    {
        $message = new \Ornamental\Message('user_welcome');
        $message->user = array('email' => 'to@example.com', 'name' => 'Joe W.');
        $message->company = 'Service Corp.';
        $message->send();

        $deliveries = \Ornamental\Deliveries::getInstance();
        $logEntry = array_shift($deliveries->log);

        $this->assertEquals('to@example.com', $logEntry->to);
        $this->assertEquals('Welcome to Ornamental, Joe W.', $logEntry->subject);
        $this->assertEquals('Service Corp.', $logEntry->fromName);
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
        $this->assertEquals('', $logEntry->fromName);
    }
}
