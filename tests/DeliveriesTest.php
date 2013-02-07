<?php

namespace Ornamental\Tests;

class DeliveriesTest extends OrnamentalTestSuite
{
    public function testSendLog()
    {
        $message = new \Ornamental\Message('user_welcome');
        $message->user = array('data' => 1);
        $message->send();

        $deliveries = \Ornamental\Deliveries::getInstance();
        $this->assertEquals(1, count($deliveries->log));
    }
}
