<?php

namespace Ornamental\Tests;

class DeliveriesTest extends OrnamentalTestSuite
{
    public function testSendLog()
    {
        $deliveries = \Ornamental\Deliveries::getInstance();
        $deliveries->reset();

        $message = new \Ornamental\Message('user_welcome');
        $message->user = array('data' => 1);
        $message->send();

        $this->assertEquals(1, count($deliveries->log));
    }
}
